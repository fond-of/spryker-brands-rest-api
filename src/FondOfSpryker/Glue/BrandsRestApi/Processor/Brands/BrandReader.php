<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Brands;

use ArrayObject;
use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface;
use Generated\Shared\Transfer\BrandListTransfer;
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
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiError;

    /**
     * @var \FondOfOryx\Glue\BrandsRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface[]
     */
    protected $filterFieldsExpanderPlugins;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface $brandClient
     * @param \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapperInterface $brandMapper
     * @param \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param array<\FondOfOryx\Glue\BrandsRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface> $filterFieldsExpanderPlugins
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        BrandsRestApiToBrandClientInterface $brandClient,
        BrandMapperInterface $brandMapper,
        RestApiErrorInterface $restApiError,
        array $filterFieldsExpanderPlugins
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->brandClient = $brandClient;
        $this->brandMapper = $brandMapper;
        $this->restApiError = $restApiError;
        $this->filterFieldsExpanderPlugins = $filterFieldsExpanderPlugins;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findBrandByUuid(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();
        $uuid = $restRequest->getResource()->getId();

        if ($uuid === null) {
            return $this->restApiError->addBrandUuidMissingError($restResponse);
        }

        $filterFieldTransfers = new ArrayObject();

        foreach ($this->filterFieldsExpanderPlugins as $filterFieldsExpanderPlugin) {
            $filterFieldTransfers = $filterFieldsExpanderPlugin->expand($restRequest, $filterFieldTransfers);
        }

        $brandListTransfer = (new BrandListTransfer())
            ->setFilterFields($filterFieldTransfers);

        $brandListTransfer = $this->brandClient->findBrands($brandListTransfer);

        $brandTransfers = $brandListTransfer->getBrands();

        if ($brandTransfers->count() !== 1 || $brandTransfers->offsetGet(0)->getUuid() !== $uuid) {
            return $this->restApiError->addBrandNotFoundError($restResponse);
        }

        $restBrandsResponseAttributesTransfer = $this->brandMapper->mapRestBrandsResponseAttributesTransfer(
            $brandTransfers->offsetGet(0)
        );

        $restResource = $this->restResourceBuilder->createRestResource(
            BrandsRestApiConfig::RESOURCE_BRANDS,
            $brandTransfers->offsetGet(0)->getUuid(),
            $restBrandsResponseAttributesTransfer
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findBrands(RestRequestInterface $restRequest): RestResponseInterface
    {
        $filterFieldTransfers = new ArrayObject();

        foreach ($this->filterFieldsExpanderPlugins as $filterFieldsExpanderPlugin) {
            $filterFieldTransfers = $filterFieldsExpanderPlugin->expand($restRequest, $filterFieldTransfers);
        }

        $brandListTransfer = (new BrandListTransfer())
            ->setFilterFields($filterFieldTransfers);

        $brandListTransfer = $this->brandClient->findBrands($brandListTransfer);

        $restResponse = $this->restResourceBuilder->createRestResponse();

        foreach ($brandListTransfer->getBrands() as $brandTransfer) {
            $restBrandsResponseAttributesTransfer = $this->brandMapper->mapRestBrandsResponseAttributesTransfer(
                $brandTransfer
            );

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
