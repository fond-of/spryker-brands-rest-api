<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Business\Reader;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface;
use FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepositoryInterface;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;

class BrandsReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\BrandsRestApi\Business\Reader\BrandsReader
     */
    protected $brandsReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandsRestApi\Persistence\BrandsRestApiRepositoryInterface
     */
    protected $brandsRestApiRepositoryInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface
     */
    protected $brandFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandTransfer
     */
    protected $brandTransferMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandsRestApiRepositoryInterfaceMock = $this->getMockBuilder(BrandsRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandFacadeInterfaceMock = $this->getMockBuilder(BrandFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->brandsReader = new BrandsReader(
            $this->brandsRestApiRepositoryInterfaceMock,
            $this->brandFacadeInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByUuid(): void
    {
        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('requireUuid')
            ->willReturnSelf();

        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->brandsRestApiRepositoryInterfaceMock->expects($this->atLeastOnce())
            ->method('findBrandByUuid')
            ->with($this->uuid)
            ->willReturn($this->brandTransferMock);

        $this->brandFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('findBrandById')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandTransferMock);

        $this->assertInstanceOf(
            BrandResponseTransfer::class,
            $this->brandsReader->findBrandByUuid(
                $this->brandTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByUuidBrandNull(): void
    {
        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('requireUuid')
            ->willReturnSelf();

        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->brandsRestApiRepositoryInterfaceMock->expects($this->atLeastOnce())
            ->method('findBrandByUuid')
            ->with($this->uuid)
            ->willReturn($this->brandTransferMock);

        $this->brandFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('findBrandById')
            ->with($this->brandTransferMock)
            ->willReturn(null);

        $this->assertInstanceOf(
            BrandResponseTransfer::class,
            $this->brandsReader->findBrandByUuid(
                $this->brandTransferMock
            )
        );
    }
}
