<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Persistence;

use Generated\Shared\Transfer\BrandTransfer;

interface BrandsRestApiRepositoryInterface
{
    /**
     * @param string $brandUuid
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function findBrandByUuid(string $brandUuid): ?BrandTransfer;
}
