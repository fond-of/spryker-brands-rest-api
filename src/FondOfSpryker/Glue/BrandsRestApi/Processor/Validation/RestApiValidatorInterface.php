<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Validation;

use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\RestUserTransfer;

interface RestApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     * @param \Generated\Shared\Transfer\RestUserTransfer $restUserTransfer
     *
     * @return bool
     */
    public function isBrandAssignedToRestUser(
        BrandTransfer $brandTransfer,
        RestUserTransfer $restUserTransfer
    ): bool;
}
