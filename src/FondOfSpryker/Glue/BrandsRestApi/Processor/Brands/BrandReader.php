<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Brands;

use FondOfSpryker\Client\BrandsRestApi\BrandsRestApiClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiValidatorInterface;
use Generated\Shared\Transfer\BrandTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class BrandReader implements BrandReaderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface
     */
    protected $brandClient;

    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapperInterface
     */
    protected $brandMapper;

    /**
     * @var \FondOfSpryker\Client\BrandsRestApi\BrandsRestApiClientInterface
     */
    protected $brandsRestApiClient;

    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiError;

    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiValidatorInterface
     */
    protected $restApiValidator;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface $brandClient
     * @param \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapperInterface $brandMapper
     * @param \FondOfSpryker\Client\BrandsRestApi\BrandsRestApiClientInterface $brandsRestApiClient
     * @param \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiValidatorInterface $restApiValidator
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        BrandsRestApiToBrandClientInterface $brandClient,
        BrandMapperInterface $brandMapper,
        BrandsRestApiClientInterface $brandsRestApiClient,
        RestApiErrorInterface $restApiError,
        RestApiValidatorInterface $restApiValidator
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->brandClient = $brandClient;
        $this->brandMapper = $brandMapper;
        $this->brandsRestApiClient = $brandsRestApiClient;
        $this->restApiError = $restApiError;
        $this->restApiValidator = $restApiValidator;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findBrandByUuid(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        if (!$restRequest->getResource()->getId()) {
            return $this->restApiError->addBrandUuidMissingError($restResponse);
        }

        $brandTransfer = (new BrandTransfer())
            ->setUuid($restRequest->getResource()->getId());

        $brandResponseTransfer = $this->brandsRestApiClient
            ->findBrandByUuid($brandTransfer);

        if (!$brandResponseTransfer->getIsSuccessful()) {
            return $this->restApiError->addBrandNotFoundError($restResponse);
        }

        if (!$this->restApiValidator->isBrandAssignedToRestUser($brandResponseTransfer->getBrand(), $restRequest->getRestUser())) {
            return $this->restApiError->addBrandNoPermissionError($restResponse);
        }

        $restBrandsResponseAttributesTransfer = $this->brandMapper
            ->mapRestBrandsResponseAttributesTransfer(
                $brandResponseTransfer->getBrand()
            );

        $restResource = $this->restResourceBuilder->createRestResource(
            BrandsRestApiConfig::RESOURCE_BRANDS,
            $brandResponseTransfer->getBrand()->getUuid(),
            $restBrandsResponseAttributesTransfer
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getActiveBrands(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $brandCollectionTransfer = $this->brandClient->getActiveBrands();

        foreach ($brandCollectionTransfer->getBrands() as $brandTransfer) {
            if (!$this->restApiValidator->isBrandAssignedToRestUser($brandTransfer, $restRequest->getRestUser())) {
                continue;
            }

            $restBrandsResponseAttributesTransfer = $this->brandMapper
                ->mapRestBrandsResponseAttributesTransfer($brandTransfer);

            $restResource = $this->restResourceBuilder->createRestResource(
                BrandsRestApiConfig::RESOURCE_BRANDS,
                $brandTransfer->getUuid(),
                $restBrandsResponseAttributesTransfer
            );

            $restResponse->addResource($restResource);
        }

        return $restResponse;
    }
}
