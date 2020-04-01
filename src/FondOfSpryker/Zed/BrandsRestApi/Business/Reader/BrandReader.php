<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Business\Reader;

use FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface;
use FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepositoryInterface;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;

class BrandReader implements BrandReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepositoryInterface
     */
    protected $brandsRestApiRepository;

    /**
     * @var \FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface
     */
    protected $brandFacade;

    /**
     * @param \FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepositoryInterface $brandsRestApiRepository
     * @param \FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface $brandFacade
     */
    public function __construct(
        BrandsRestApiRepositoryInterface $brandsRestApiRepository,
        BrandFacadeInterface $brandFacade
    ) {
        $this->brandsRestApiRepository = $brandsRestApiRepository;
        $this->brandFacade = $brandFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function findBrandByUuid(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        $brandTransfer->requireUuid();

        $brandTransfer = $this->brandsRestApiRepository->findBrandByUuid(
            $brandTransfer->getUuid()
        );

        $brandTransfer = $this->brandFacade->findBrandById($brandTransfer);

        $brandResponseTransfer = new BrandResponseTransfer();

        if (!$brandTransfer) {
            return $brandResponseTransfer->setIsSuccessful(false);
        }

        return $brandResponseTransfer
            ->setIsSuccessful(true)
            ->setBrand($brandTransfer);
    }
}
