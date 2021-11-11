<?php

namespace FondOfSpryker\Glue\BrandsRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandReader;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\Kernel\Container;

class BrandsRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface
     */
    protected $brandMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandMock = $this->getMockBuilder(BrandsRestApiToBrandClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new class ($this->restResourceBuilderMock) extends BrandsRestApiFactory {
            /**
             * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            protected $restResourceBuilder;

            /**
             * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
             */
            public function __construct(RestResourceBuilderInterface $restResourceBuilder)
            {
                $this->restResourceBuilder = $restResourceBuilder;
            }

            /**
             * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
             */
            public function getResourceBuilder(): RestResourceBuilderInterface
            {
                return $this->restResourceBuilder;
            }
        };

        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateBrandReader(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [BrandsRestApiDependencyProvider::CLIENT_BRAND],
                [BrandsRestApiDependencyProvider::PLUGINS_FILTER_FIELDS_EXPANDER]
            )->willReturnOnConsecutiveCalls($this->brandMock, []);

        static::assertInstanceOf(
            BrandReader::class,
            $this->factory->createBrandReader()
        );
    }
}
