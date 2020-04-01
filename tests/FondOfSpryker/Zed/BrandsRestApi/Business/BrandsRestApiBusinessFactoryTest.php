<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface;
use FondOfSpryker\Zed\BrandsRestApi\BrandsRestApiDependencyProvider;
use FondOfSpryker\Zed\BrandsRestApi\Business\Reader\BrandReaderInterface;
use FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepository;
use Spryker\Zed\Kernel\Container;

class BrandsRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\BrandsRestApi\Business\BrandsRestApiBusinessFactory
     */
    protected $brandsRestApiBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepository
     */
    protected $brandsRestApiRepositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface
     */
    protected $brandFacadeInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandsRestApiRepositoryMock = $this->getMockBuilder(BrandsRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandFacadeInterfaceMock = $this->getMockBuilder(BrandFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiBusinessFactory = new BrandsRestApiBusinessFactory();
        $this->brandsRestApiBusinessFactory->setRepository($this->brandsRestApiRepositoryMock);
        $this->brandsRestApiBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateBrandReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(BrandsRestApiDependencyProvider::BRAND_FACADE)
            ->willReturn($this->brandFacadeInterfaceMock);

        $this->assertInstanceOf(
            BrandReaderInterface::class,
            $this->brandsRestApiBusinessFactory->createBrandReader()
        );
    }
}
