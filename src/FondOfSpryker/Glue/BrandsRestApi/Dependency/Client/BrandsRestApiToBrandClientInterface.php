<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Dependency\Client;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandListTransfer;

interface BrandsRestApiToBrandClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandListTransfer
     */
    public function findBrands(BrandListTransfer $brandListTransfer): BrandListTransfer;
}
