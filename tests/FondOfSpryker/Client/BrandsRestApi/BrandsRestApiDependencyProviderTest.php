<?php

namespace FondOfSpryker\Client\BrandsRestApi;

use Codeception\Test\Unit;
use Spryker\Client\Kernel\Container;

class BrandsRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\BrandsRestApi\BrandsRestApiDependencyProvider
     */
    protected $brandsRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiDependencyProvider = new BrandsRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->brandsRestApiDependencyProvider->provideServiceLayerDependencies(
                $this->containerMock
            )
        );
    }
}
