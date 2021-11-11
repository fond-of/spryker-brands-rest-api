<?php

namespace FondOfSpryker\Glue\BrandsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\Brand\BrandClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use Spryker\Client\Kernel\Locator;
use Spryker\Glue\Kernel\Container;
use Spryker\Shared\Kernel\BundleProxy;

class BrandsRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\Brand\BrandClientInterface
     */
    protected $brandClientMock;

    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandClientMock = $this->getMockBuilder(BrandClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new BrandsRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('brand')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('client')
            ->willReturn($this->brandClientMock);

        $container = $this->dependencyProvider->provideDependencies($this->containerMock);

        static::assertInstanceOf(
            BrandsRestApiToBrandClientInterface::class,
            $container[BrandsRestApiDependencyProvider::CLIENT_BRAND]
        );

        static::assertCount(
            0,
            $container[BrandsRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER]
        );
    }
}
