<?php

namespace FondOfSpryker\Client\BrandsRestApi\Zed;

use FondOfSpryker\Client\BrandsRestApi\Dependency\Client\BrandsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;

interface BrandsRestApiStubInterface
{
    /**
     * @param \FondOfSpryker\Client\BrandsRestApi\Dependency\Client\BrandsRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(BrandsRestApiToZedRequestClientInterface $zedRequestClient);

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function findBrandByUuid(BrandTransfer $brandTransfer): BrandResponseTransfer;
}
