<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Business;

use FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface;
use FondOfSpryker\Zed\BrandsRestApi\BrandsRestApiDependencyProvider;
use FondOfSpryker\Zed\BrandsRestApi\Business\Reader\BrandsReader;
use FondOfSpryker\Zed\BrandsRestApi\Business\Reader\BrandsReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepositoryInterface getRepository()
 */
class BrandsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\BrandsRestApi\Business\Reader\BrandsReaderInterface
     */
    public function createBrandsReader(): BrandsReaderInterface
    {
        return new BrandsReader(
            $this->getRepository(),
            $this->getBrandFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface
     */
    protected function getBrandFacade(): BrandFacadeInterface
    {
        return $this->getProvidedDependency(BrandsRestApiDependencyProvider::BRAND_FACADE);
    }
}
