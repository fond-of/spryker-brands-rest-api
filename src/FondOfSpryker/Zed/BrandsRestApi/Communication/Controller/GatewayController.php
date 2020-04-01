<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Communication\Controller;

use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfSpryker\Zed\BrandsRestApi\Business\BrandsRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function findBrandByUuidAction(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        return $this->getFacade()->findBrandByUuid($brandTransfer);
    }
}
