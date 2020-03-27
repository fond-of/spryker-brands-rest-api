<?php

namespace FondOfSpryker\Client\BrandsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\BrandsRestApi\Zed\BrandsRestApiStubInterface;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;

class BrandsRestApiClientTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\BrandsRestApi\BrandsRestApiClient
     */
    protected $brandsRestApiClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandTransfer
     */
    protected $brandTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\BrandsRestApi\BrandsRestApiFactory
     */
    protected $brandsRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\BrandsRestApi\Zed\BrandsRestApiStubInterface
     */
    protected $brandsRestApiStubInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected $brandResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiFactoryMock = $this->getMockBuilder(BrandsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiStubInterfaceMock = $this->getMockBuilder(BrandsRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandResponseTransferMock = $this->getMockBuilder(BrandResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiClient = new BrandsRestApiClient();
        $this->brandsRestApiClient->setFactory($this->brandsRestApiFactoryMock);
    }

    /**
     * @return void
     */
    public function testFindBrandByUuid(): void
    {
        $this->brandsRestApiFactoryMock->expects($this->atLeastOnce())
            ->method('createZedBrandsRestApiStub')
            ->willReturn($this->brandsRestApiStubInterfaceMock);

        $this->brandsRestApiStubInterfaceMock->expects($this->atLeastOnce())
            ->method('findBrandByUuid')
            ->with($this->brandTransferMock)
            ->willReturn($this->brandResponseTransferMock);

        $this->assertInstanceOf(
            BrandResponseTransfer::class,
            $this->brandsRestApiClient->findBrandByUuid(
                $this->brandTransferMock
            )
        );
    }
}
