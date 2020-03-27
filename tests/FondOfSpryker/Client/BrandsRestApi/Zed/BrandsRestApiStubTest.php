<?php

namespace FondOfSpryker\Client\BrandsRestApi\Zed;

use Codeception\Test\Unit;
use FondOfSpryker\Client\BrandsRestApi\Dependency\Client\BrandsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;

class BrandsRestApiStubTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\BrandsRestApi\Zed\BrandsRestApiStub
     */
    protected $brandsRestApiStub;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\BrandsRestApi\Dependency\Client\BrandsRestApiToZedRequestClientInterface
     */
    protected $brandsRestApiToZedRequestClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandTransfer
     */
    protected $brandTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected $brandResponseTransferMock;

    /**
     * @var string
     */
    protected $url;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandsRestApiToZedRequestClientInterfaceMock = $this->getMockBuilder(BrandsRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandResponseTransferMock = $this->getMockBuilder(BrandResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->url = '/brands-rest-api/gateway/find-brand-by-uuid';

        $this->brandsRestApiStub = new BrandsRestApiStub(
            $this->brandsRestApiToZedRequestClientInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByUuid(): void
    {
        $this->brandsRestApiToZedRequestClientInterfaceMock->expects($this->atLeastOnce())
            ->method('call')
            ->with($this->url, $this->brandTransferMock)
            ->willReturn($this->brandResponseTransferMock);

        $this->assertInstanceOf(
            BrandResponseTransfer::class,
            $this->brandsRestApiStub->findBrandByUuid(
                $this->brandTransferMock
            )
        );
    }
}
