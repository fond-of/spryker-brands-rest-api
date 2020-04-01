<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Brands;

use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\RestBrandsResponseAttributesTransfer;

class BrandMapper implements BrandMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\RestBrandsResponseAttributesTransfer
     */
    public function mapRestBrandsResponseAttributesTransfer(
        BrandTransfer $brandTransfer
    ): RestBrandsResponseAttributesTransfer {
        $restBrandsResponseAttributesTransfer = new RestBrandsResponseAttributesTransfer();

        $restBrandsResponseAttributesTransfer->fromArray(
            $brandTransfer->toArray(),
            true
        );

        return $restBrandsResponseAttributesTransfer;
    }
}
