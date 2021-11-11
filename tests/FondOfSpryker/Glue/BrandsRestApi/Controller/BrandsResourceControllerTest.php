<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Controller;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiFactory;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandReaderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class BrandsResourceControllerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiFactory
     */
    protected $brandsRestApiFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandReaderInterface
     */
    protected $brandReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Controller\BrandsResourceController
     */
    protected $brandsResourceController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandsRestApiFactoryMock = $this->getMockBuilder(BrandsRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandReaderMock = $this->getMockBuilder(BrandReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsResourceController = new class (
            $this->brandsRestApiFactoryMock
        ) extends BrandsResourceController {
            /**
             * @var \FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiFactory
             */
            protected $brandsRestApiFactory;

            /**
             * @param \FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiFactory $brandsRestApiFactory
             */
            public function __construct(BrandsRestApiFactory $brandsRestApiFactory)
            {
                $this->brandsRestApiFactory = $brandsRestApiFactory;
            }

            /**
             * @return \FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiFactory
             */
            public function getFactory(): BrandsRestApiFactory
            {
                return $this->brandsRestApiFactory;
            }
        };
    }

    /**
     * @return void
     */
    public function testGetActionWithResourceId(): void
    {
        $resourceId = '8bb8ea24-51f1-47b6-9291-95d37611108e';

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($resourceId);

        $this->brandsRestApiFactoryMock->expects(static::atLeastOnce())
            ->method('createBrandReader')
            ->willReturn($this->brandReaderMock);

        $this->brandReaderMock->expects(static::atLeastOnce())
            ->method('findBrandByUuid')
            ->with($this->restRequestMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->brandsResourceController->getAction(
                $this->restRequestMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetAction(): void
    {
        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn(null);

        $this->brandsRestApiFactoryMock->expects(static::atLeastOnce())
            ->method('createBrandReader')
            ->willReturn($this->brandReaderMock);

        $this->brandReaderMock->expects(static::atLeastOnce())
            ->method('findBrands')
            ->with($this->restRequestMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->brandsResourceController->getAction(
                $this->restRequestMock
            )
        );
    }
}
