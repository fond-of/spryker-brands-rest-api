<?php

namespace FondOfSpryker\Glue\BrandsRestApi;

use Codeception\Test\Unit;
use Spryker\Glue\Kernel\Container;

class BrandsRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiDependencyProvider
     */
    protected $brandsRestApiDependencyProvider;

    /**BrandsResourceController
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiDependencyProvider = new BrandsRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->brandsRestApiDependencyProvider->provideDependencies($this->containerMock)
        );
    }
}
