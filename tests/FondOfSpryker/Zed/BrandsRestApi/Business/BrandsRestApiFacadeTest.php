<?php

namespace FondOfSpryker\Zed\BrandsRestApi\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\BrandsRestApi\Business\Reader\BrandsReaderInterface;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;

class BrandsRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\BrandsRestApi\Business\BrandsRestApiFacade
     */
    protected $brandsRestApiFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandTransfer
     */
    protected $brandTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandsRestApi\Business\BrandsRestApiBusinessFactory
     */
    protected $brandsRestApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandsRestApi\Business\Reader\BrandsReaderInterface
     */
    protected $brandsReaderInterfaceMock;

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

        $this->brandsRestApiBusinessFactoryMock = $this->getMockBuilder(BrandsRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsReaderInterfaceMock = $this->getMockBuilder(BrandsReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandResponseTransferMock = $this->getMockBuilder(BrandResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiFacade = new BrandsRestApiFacade();
        $this->brandsRestApiFacade->setFactory($this->brandsRestApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testFindBrandByUuid(): void
    {
        $this->brandsRestApiBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createBrandsReader')
            ->willReturn($this->brandsReaderInterfaceMock);

        $this->brandsReaderInterfaceMock->expects($this->atLeastOnce())
            ->method('findBrandByUuid')
            ->willReturn($this->brandResponseTransferMock);

        $this->assertInstanceOf(
            BrandResponseTransfer::class,
            $this->brandsRestApiFacade->findBrandByUuid(
                $this->brandTransferMock
            )
        );
    }
}
