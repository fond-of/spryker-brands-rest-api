<?php

namespace FondOfSpryker\Client\BrandsRestApi;

use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;

interface BrandsRestApiClientInterface
{
    /**
     * Specification:
     * - Finds a brand by uuid.
     * - Makes zed request.
     * - Requires uuid field to be set in BrandTransfer taken as parameter.
     *
     * @api
     *
     * {@internal will work if UUID field is provided.}
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function findBrandByUuid(BrandTransfer $brandTransfer): BrandResponseTransfer;
}
