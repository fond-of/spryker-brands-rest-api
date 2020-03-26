<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Persistence;

use FondOfSpryker\Zed\BrandsRestApi\Persistence\Mapper\BrandsMapper;
use FondOfSpryker\Zed\BrandsRestApi\Persistence\Mapper\BrandsMapperInterface;
use Orm\Zed\Brand\Persistence\FosBrandQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepositoryInterface getRepository()
 */
class BrandsRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Brand\Persistence\FosBrandQuery
     */
    public function createBrandQuery(): FosBrandQuery
    {
        return FosBrandQuery::create();
    }

    /**
     * @return \FondOfSpryker\Zed\BrandsRestApi\Persistence\Mapper\BrandsMapperInterface
     */
    public function createBrandsMapper(): BrandsMapperInterface
    {
        return new BrandsMapper();
    }
}
