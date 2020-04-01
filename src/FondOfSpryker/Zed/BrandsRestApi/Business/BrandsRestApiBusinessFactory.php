<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Business;

use FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface;
use FondOfSpryker\Zed\BrandsRestApi\BrandsRestApiDependencyProvider;
use FondOfSpryker\Zed\BrandsRestApi\Business\Reader\BrandReader;
use FondOfSpryker\Zed\BrandsRestApi\Business\Reader\BrandReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepositoryInterface getRepository()
 */
class BrandsRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\BrandsRestApi\Business\Reader\BrandReaderInterface
     */
    public function createBrandReader(): BrandReaderInterface
    {
        return new BrandReader(
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
