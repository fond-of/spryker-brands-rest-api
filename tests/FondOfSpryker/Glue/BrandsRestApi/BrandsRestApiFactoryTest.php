<?php

namespace FondOfSpryker\Glue\BrandsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapper;

class BrandsRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiFactory
     */
    protected $brandsRestApiFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandsRestApiFactory = new BrandsRestApiFactory();
    }

    /**
     * @return void
     */
    public function testCreateBrandsMapper(): void
    {
        $this->assertInstanceOf(
            BrandMapper::class,
            $this->brandsRestApiFactory->createBrandMapper()
        );
    }
}
