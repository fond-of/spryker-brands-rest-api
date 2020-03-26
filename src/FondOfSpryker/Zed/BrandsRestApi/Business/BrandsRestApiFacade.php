<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Business;

use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\BrandsRestApi\Business\BrandsRestApiBusinessFactory getFactory()
 */
class BrandsRestApiFacade extends AbstractFacade implements BrandsRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function findBrandByUuid(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        return $this->getFactory()->createBrandsReader()->findBrandByUuid($brandTransfer);
    }
}
