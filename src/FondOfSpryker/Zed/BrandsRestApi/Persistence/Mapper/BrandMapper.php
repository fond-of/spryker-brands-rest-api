<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Persistence\Mapper;

use Generated\Shared\Transfer\BrandTransfer;
use Orm\Zed\Brand\Persistence\FosBrand;

class BrandMapper implements BrandMapperInterface
{
    /**
     * @param \Orm\Zed\Brand\Persistence\FosBrand $fosBrand
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandTransfer
     */
    public function mapEntityToTransfer(
        FosBrand $fosBrand,
        BrandTransfer $brandTransfer
    ): BrandTransfer {
        return $brandTransfer->fromArray($fosBrand->toArray(), true);
    }
}
