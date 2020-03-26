<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Brands;

use FondOfSpryker\Client\BrandsRestApi\BrandsRestApiClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiValidatorInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface BrandsReaderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface $brandClient
     * @param \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsMapperInterface $brandsMapper
     * @param \FondOfSpryker\Client\BrandsRestApi\BrandsRestApiClientInterface $brandsRestApiClient
     * @param \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface $restApiError
     * @param \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiValidatorInterface $restApiValidator
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        BrandsRestApiToBrandClientInterface $brandClient,
        BrandsMapperInterface $brandsMapper,
        BrandsRestApiClientInterface $brandsRestApiClient,
        RestApiErrorInterface $restApiError,
        RestApiValidatorInterface $restApiValidator
    );

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function findBrandByUuid(RestRequestInterface $restRequest): RestResponseInterface;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getActiveBrands(RestRequestInterface $restRequest): RestResponseInterface;
}
