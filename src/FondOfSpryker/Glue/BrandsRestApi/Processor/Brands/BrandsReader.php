<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Brands;

use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class BrandsReader implements BrandsReaderInterface
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
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsMapperInterface
     */
    protected $brandsMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface $brandClient
     * @param \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsMapperInterface $brandsMapper
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        BrandsRestApiToBrandClientInterface $brandClient,
        BrandsMapperInterface $brandsMapper
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->brandClient = $brandClient;
        $this->brandsMapper = $brandsMapper;
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
            $restBrandsResponseAttributesTransfer = $this->brandsMapper
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
