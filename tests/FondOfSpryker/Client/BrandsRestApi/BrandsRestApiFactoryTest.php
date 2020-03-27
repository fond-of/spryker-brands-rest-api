<?php

namespace FondOfSpryker\Client\BrandsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\BrandsRestApi\Dependency\Client\BrandsRestApiToZedRequestClientInterface;
use FondOfSpryker\Client\BrandsRestApi\Zed\BrandsRestApiStubInterface;
use Spryker\Client\Kernel\Container;

class BrandsRestApiFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\BrandsRestApi\BrandsRestApiFactory
     */
    protected $brandsRestApiFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\BrandsRestApi\Dependency\Client\BrandsRestApiToZedRequestClientInterface
     */
    protected $brandsRestApiToZedRequestClientInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiToZedRequestClientInterfaceMock = $this->getMockBuilder(BrandsRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiFactory = new BrandsRestApiFactory();
        $this->brandsRestApiFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedBrandsRestApiStub(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(BrandsRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->brandsRestApiToZedRequestClientInterfaceMock);

        $this->assertInstanceOf(
            BrandsRestApiStubInterface::class,
            $this->brandsRestApiFactory->createZedBrandsRestApiStub()
        );
    }
}
