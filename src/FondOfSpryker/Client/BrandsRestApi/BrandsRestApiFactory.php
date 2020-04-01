<?php

namespace FondOfSpryker\Client\BrandsRestApi;

use FondOfSpryker\Client\BrandsRestApi\Dependency\Client\BrandsRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\BrandsRestApi\Zed\BrandsRestApiStub;
use FondOfSpryker\Client\BrandsRestApi\Zed\BrandsRestApiStubInterface;
use Spryker\Client\Kernel\AbstractFactory;

class BrandsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\BrandsRestApi\Zed\BrandsRestApiStubInterface
     */
    public function createZedBrandsRestApiStub(): BrandsRestApiStubInterface
    {
        return new BrandsRestApiStub($this->getZedRequestClient());
    }

    /**
     * @return \FondOfSpryker\Client\BrandsRestApi\Dependency\Client\BrandsRestApiToZedRequestClientInterface
     */
    protected function getZedRequestClient(): BrandsRestApiToZedRequestClientInterface
    {
        return $this->getProvidedDependency(BrandsRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }
}
