<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfSpryker\Client\Brand\BrandClientInterface;
use Generated\Shared\Transfer\BrandListTransfer;

class BrandsRestApiToBrandClientBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientBridge
     */
    protected $bridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\Brand\BrandClientInterface
     */
    protected $brandClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandListTransfer
     */
    protected $brandListTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandClientMock = $this->getMockBuilder(BrandClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandListTransferMock = $this->getMockBuilder(BrandListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new BrandsRestApiToBrandClientBridge(
            $this->brandClientMock
        );
    }

    /**
     * @return void
     */
    public function testFindBrands(): void
    {
        $this->brandClientMock->expects(static::atLeastOnce())
            ->method('findBrands')
            ->with($this->brandListTransferMock)
            ->willReturn($this->brandListTransferMock);

        static::assertEquals(
            $this->brandListTransferMock,
            $this->bridge->findBrands($this->brandListTransferMock)
        );
    }
}
