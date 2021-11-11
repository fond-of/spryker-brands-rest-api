<?php

namespace FondOfSpryker\Glue\BrandsRestApi;

use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapper;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapperInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandReader;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandReaderInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiError;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

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
            $this->createRestApiError(),
            $this->getFilterFieldsExpanderPlugins()
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
     * @return array<\FondOfOryx\Glue\BrandsRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface>
     */
    protected function getFilterFieldsExpanderPlugins(): array
    {
        return $this->getProvidedDependency(BrandsRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER);
    }
}
