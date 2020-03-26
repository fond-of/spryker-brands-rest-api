<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Persistence\Mapper;

use Generated\Shared\Transfer\BrandTransfer;
use Orm\Zed\Brand\Persistence\FosBrand;

interface BrandsMapperInterface
{
    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrand $fosBrand
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapEntityToBrandTransfer(
        FosBrand $fosBrand,
        BrandTransfer $brandTransfer
    ): BrandTransfer;
}
