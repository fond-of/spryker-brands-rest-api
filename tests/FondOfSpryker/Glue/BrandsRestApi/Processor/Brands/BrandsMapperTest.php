<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Brands;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\RestBrandsResponseAttributesTransfer;

class BrandsMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandsMapper
     */
    protected $brandsMapper;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandTransfer
     */
    protected $brandTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsMapper = new BrandsMapper();
    }

    /**
     * @return void
     */
    public function testMapRestBrandsResponseAttributesTransfer(): void
    {
        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->assertInstanceOf(
            RestBrandsResponseAttributesTransfer::class,
            $this->brandsMapper->mapRestBrandsResponseAttributesTransfer($this->brandTransferMock)
        );
    }
}
