<?php

namespace FondOfSpryker\Glue\BrandsRestApi;

use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsMapper;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsMapperInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsReader;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsReaderInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsResourceRelationshipExpander;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsResourceRelationshipExpanderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

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
            $this->createBrandsMapper()
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
     * @throws
     *
     * @return \FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface
     */
    protected function getBrandClient(): BrandsRestApiToBrandClientInterface
    {
        return $this->getProvidedDependency(BrandsRestApiDependencyProvider::CLIENT_BRAND);
    }

    /**
     * @return \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsResourceRelationshipExpanderInterface
     */
    public function createBrandsResourceRelationshipExpander(): BrandsResourceRelationshipExpanderInterface
    {
        return new BrandsResourceRelationshipExpander(
            $this->getResourceBuilder(),
            $this->createBrandsMapper()
        );
    }
}
