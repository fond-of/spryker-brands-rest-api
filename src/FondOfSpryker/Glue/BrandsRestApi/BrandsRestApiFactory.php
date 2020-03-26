<?php

namespace FondOfSpryker\Glue\BrandsRestApi;

use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsMapper;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsMapperInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsReader;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsReaderInterface;
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
     * @return \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsReaderInterface
     */
    public function createBrandsReader(): BrandsReaderInterface
    {
        return new BrandsReader(
            $this->getResourceBuilder(),
            $this->getBrandClient(),
            $this->createBrandsMapper(),
            $this->getClient(),
            $this->createRestApiError(),
            $this->createRestApiValidator()
        );
    }

    /**
     * @return \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsMapperInterface
     */
    public function createBrandsMapper(): BrandsMapperInterface
    {
        return new BrandsMapper();
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
