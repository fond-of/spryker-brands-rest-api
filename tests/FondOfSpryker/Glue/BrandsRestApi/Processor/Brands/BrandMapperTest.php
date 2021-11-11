<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Brands;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\RestBrandsResponseAttributesTransfer;

class BrandMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapper
     */
    protected $brandMapper;

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

        $this->brandMapper = new BrandMapper();
    }

    /**
     * @return void
     */
    public function testMapRestBrandsResponseAttributesTransfer(): void
    {
        $this->brandTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        static::assertInstanceOf(
            RestBrandsResponseAttributesTransfer::class,
            $this->brandMapper->mapRestBrandsResponseAttributesTransfer($this->brandTransferMock)
        );
    }
}
