<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Persistence;

use Generated\Shared\Transfer\BrandTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiPersistenceFactory getFactory()
 */
class BrandsRestApiRepository extends AbstractRepository implements BrandsRestApiRepositoryInterface
{
    /**
     * @param string $brandUuid
     *
     * @return \Generated\Shared\Transfer\BrandTransfer|null
     */
    public function findBrandByUuid(string $brandUuid): ?BrandTransfer
    {
        $brandEntity = $this->getFactory()
            ->createBrandQuery()
            ->filterByUuid($brandUuid)
            ->findOne();

        if (!$brandEntity) {
            return null;
        }

        return $this->getFactory()
            ->createBrandMapper()
            ->mapEntityToTransfer($brandEntity, new BrandTransfer());
    }
}
