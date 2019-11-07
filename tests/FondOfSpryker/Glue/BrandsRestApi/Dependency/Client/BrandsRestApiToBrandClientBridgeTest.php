<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfSpryker\Client\Brand\BrandClientInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;

class BrandsRestApiToBrandClientBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientBridge
     */
    protected $brandsRestApiToBrandClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\Brand\BrandClientInterface
     */
    protected $brandClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandCollectionTransfer
     */
    protected $brandCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandClientInterfaceMock = $this->getMockBuilder(BrandClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCollectionTransferMock = $this->getMockBuilder(BrandCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiToBrandClientBridge = new BrandsRestApiToBrandClientBridge(
            $this->brandClientInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetActiveBrands(): void
    {
        $this->brandClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveBrands')
            ->willReturn($this->brandCollectionTransferMock);

        $this->assertInstanceOf(BrandCollectionTransfer::class, $this->brandsRestApiToBrandClientBridge->getActiveBrands());
    }
}
