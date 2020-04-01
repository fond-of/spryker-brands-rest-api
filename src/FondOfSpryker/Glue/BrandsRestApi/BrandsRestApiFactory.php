<?php

namespace FondOfSpryker\Glue\BrandsRestApi;

use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapper;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapperInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandReader;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandReaderInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiError;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiValidator;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiValidatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\BrandsRestApi\BrandsRestApiClientInterface getClient()
 */
class BrandsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandReaderInterface
     */
    public function createBrandReader(): BrandReaderInterface
    {
        return new BrandReader(
            $this->getResourceBuilder(),
            $this->getBrandClient(),
            $this->createBrandMapper(),
            $this->getClient(),
            $this->createRestApiError(),
            $this->createRestApiValidator()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapperInterface
     */
    public function createBrandMapper(): BrandMapperInterface
    {
        return new BrandMapper();
    }

    /**
     * @return \FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface
     */
    protected function getBrandClient(): BrandsRestApiToBrandClientInterface
    {
        return $this->getProvidedDependency(BrandsRestApiDependencyProvider::CLIENT_BRAND);
    }

    /**
     * @return \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected function createRestApiError(): RestApiErrorInterface
    {
        return new RestApiError();
    }

    /**
     * @return \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiValidatorInterface
     */
    protected function createRestApiValidator(): RestApiValidatorInterface
    {
        return new RestApiValidator();
    }
}
