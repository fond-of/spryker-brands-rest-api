<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Brands;

use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class BrandsResourceRelationshipExpander implements BrandsResourceRelationshipExpanderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsMapperInterface
     */
    protected $brandsMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsMapperInterface $brandsMapper
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        BrandsMapperInterface $brandsMapper
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->brandsMapper = $brandsMapper;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[]
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): array
    {
        foreach ($resources as $resource) {
            /**
             * @var \Generated\Shared\Transfer\CompanyUserTransfer|null $payload
             */
            $payload = $resource->getPayload();

            if ($payload === null || !($payload instanceof CompanyUserTransfer)) {
                continue;
            }

            $companyTransfer = $payload->getCompany();

            if ($companyTransfer === null) {
                continue;
            }

            $brandRelationTransfer = $companyTransfer->getBrandRelation();

            if ($brandRelationTransfer === null) {
                continue;
            }

            foreach ($brandRelationTransfer->getBrands() as $brandTransfer) {
                $restBrandsResponseAttributesTransfer = $this->brandsMapper
                    ->mapRestBrandsResponseAttributesTransfer($brandTransfer);

                $brandResource = $this->restResourceBuilder->createRestResource(
                    BrandsRestApiConfig::RESOURCE_BRANDS,
                    $brandTransfer->getUuid(),
                    $restBrandsResponseAttributesTransfer
                );

                $resource->addRelationship($brandResource);
            }
        }

        return $resources;
    }
}
