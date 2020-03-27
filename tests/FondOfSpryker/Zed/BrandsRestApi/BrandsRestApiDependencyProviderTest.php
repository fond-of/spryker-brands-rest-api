<?php

namespace FondOfSpryker\Zed\BrandsRestApi;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class BrandsRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\BrandsRestApi\BrandsRestApiDependencyProvider
     */
    protected $brandsRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
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
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->brandsRestApiDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock
            )
        );
    }
}
