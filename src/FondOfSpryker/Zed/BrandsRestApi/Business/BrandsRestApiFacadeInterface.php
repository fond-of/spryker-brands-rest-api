<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Business;

use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;

interface BrandsRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function findBrandByUuid(BrandTransfer $brandTransfer): BrandResponseTransfer;
}
