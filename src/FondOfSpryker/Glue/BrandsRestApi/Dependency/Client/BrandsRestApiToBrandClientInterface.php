<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Dependency\Client;

use Generated\Shared\Transfer\BrandCollectionTransfer;

interface BrandsRestApiToBrandClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer;
}
