<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Persistence;

use FondOfSpryker\Zed\BrandsRestApi\Persistence\Mapper\BrandMapper;
use FondOfSpryker\Zed\BrandsRestApi\Persistence\Mapper\BrandMapperInterface;
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
     * @return \FondOfSpryker\Zed\BrandsRestApi\Persistence\Mapper\BrandMapperInterface
     */
    public function createBrandMapper(): BrandMapperInterface
    {
        return new BrandMapper();
    }
}
