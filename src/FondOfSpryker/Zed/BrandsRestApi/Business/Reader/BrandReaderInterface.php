<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Business\Reader;

use FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface;
use FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepositoryInterface;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;

interface BrandReaderInterface
{
    /**
     * @param \FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepositoryInterface $brandsRestApiRepository
     * @param \FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface $brandFacade
     */
    public function __construct(
        BrandsRestApiRepositoryInterface $brandsRestApiRepository,
        BrandFacadeInterface $brandFacade
    );

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function findBrandByUuid(BrandTransfer $brandTransfer): BrandResponseTransfer;
}
