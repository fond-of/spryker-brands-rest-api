<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Brands;

use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\RestBrandsResponseAttributesTransfer;

interface BrandsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\RestBrandsResponseAttributesTransfer
     */
    public function mapRestBrandsResponseAttributesTransfer(
        BrandTransfer $brandTransfer
    ): RestBrandsResponseAttributesTransfer;
}
