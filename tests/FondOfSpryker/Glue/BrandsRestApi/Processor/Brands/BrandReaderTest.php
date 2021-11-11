<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Brands;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\BrandsRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface;
use Generated\Shared\Transfer\BrandListTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\RestBrandsResponseAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class BrandReaderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface
     */
    protected $brandClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapperInterface
     */
    protected $brandMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiErrorMock;

    /**
     * @var array<\FondOfOryx\Glue\BrandsRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $filterFieldsExpanderPluginMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandListTransfer
     */
    protected $brandListTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandTransfer
     */
    protected $brandTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestBrandsResponseAttributesTransfer
     */
    protected $restBrandsResponseAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandReader
     */
    protected $brandReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandClientMock = $this->getMockBuilder(BrandsRestApiToBrandClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandMapperMock = $this->getMockBuilder(BrandMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiErrorMock = $this->getMockBuilder(RestApiErrorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldsExpanderPluginMocks = [
            $this->getMockBuilder(FilterFieldsExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandListTransferMock = $this->getMockBuilder(BrandListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBrandsResponseAttributesTransferMock = $this->getMockBuilder(RestBrandsResponseAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandReader = new BrandReader(
            $this->restResourceBuilderMock,
            $this->brandClientMock,
            $this->brandMapperMock,
            $this->restApiErrorMock,
            $this->filterFieldsExpanderPluginMocks
        );
    }

    /**
     * @return void
     */
    public function testFindBrands(): void
    {
        $uuid = 'cf462b2e-42f6-11ec-81d3-0242ac130003';

        $filterFieldTransfers = new ArrayObject();

        $this->filterFieldsExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restRequestMock, static::callback(
                static function (ArrayObject $filterFieldTransfers) {
                    return $filterFieldTransfers->count() === 0;
                }
            ))->willReturn($filterFieldTransfers);

        $this->brandClientMock->expects(static::atLeastOnce())
            ->method('findBrands')
            ->with(
                static::callback(
                    static function (BrandListTransfer $brandListTransfer) use ($filterFieldTransfers) {
                        return $brandListTransfer->getFilterFields() === $filterFieldTransfers;
                    }
                )
            )->willReturn($this->brandListTransferMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->brandListTransferMock->expects(static::atLeastOnce())
            ->method('getBrands')
            ->willReturn(new ArrayObject([$this->brandTransferMock]));

        $this->brandMapperMock->expects(static::atLeastOnce())
            ->method('mapRestBrandsResponseAttributesTransfer')
            ->with($this->brandTransferMock)
            ->willReturn($this->restBrandsResponseAttributesTransferMock);

        $this->brandTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                BrandsRestApiConfig::RESOURCE_BRANDS,
                $uuid,
                $this->restBrandsResponseAttributesTransferMock
            )->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->brandReader->findBrands($this->restRequestMock)
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByUuid(): void
    {
        $uuid = 'cf462b2e-42f6-11ec-81d3-0242ac130003';
        $filterFieldTransfers = new ArrayObject();

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($uuid);

        $this->restApiErrorMock->expects(static::never())
            ->method('addBrandUuidMissingError');

        $this->filterFieldsExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restRequestMock, static::callback(
                static function (ArrayObject $filterFieldTransfers) {
                    return $filterFieldTransfers->count() === 0;
                }
            ))->willReturn($filterFieldTransfers);

        $this->brandClientMock->expects(static::atLeastOnce())
            ->method('findBrands')
            ->with(
                static::callback(
                    static function (BrandListTransfer $brandListTransfer) use ($filterFieldTransfers) {
                        return $brandListTransfer->getFilterFields() === $filterFieldTransfers;
                    }
                )
            )->willReturn($this->brandListTransferMock);

        $this->brandListTransferMock->expects(static::atLeastOnce())
            ->method('getBrands')
            ->willReturn(new ArrayObject([$this->brandTransferMock]));

        $this->brandTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->restApiErrorMock->expects(static::never())
            ->method('addBrandNotFoundError');

        $this->brandMapperMock->expects(static::atLeastOnce())
            ->method('mapRestBrandsResponseAttributesTransfer')
            ->with($this->brandTransferMock)
            ->willReturn($this->restBrandsResponseAttributesTransferMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                BrandsRestApiConfig::RESOURCE_BRANDS,
                $uuid,
                $this->restBrandsResponseAttributesTransferMock
            )->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->brandReader->findBrandByUuid($this->restRequestMock)
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByUuidWithoutResourceId(): void
    {
        $uuid = null;

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($uuid);

        $this->restApiErrorMock->expects(static::atLeastOnce())
            ->method('addBrandUuidMissingError')
            ->with($this->restResponseMock)
            ->willReturn($this->restResponseMock);

        $this->filterFieldsExpanderPluginMocks[0]->expects(static::never())
            ->method('expand');

        $this->brandClientMock->expects(static::never())
            ->method('findBrands');

        $this->restApiErrorMock->expects(static::never())
            ->method('addBrandNotFoundError');

        $this->brandMapperMock->expects(static::never())
            ->method('mapRestBrandsResponseAttributesTransfer');

        $this->restResourceBuilderMock->expects(static::never())
            ->method('createRestResource');

        $this->restResponseMock->expects(static::never())
            ->method('addResource');

        static::assertEquals(
            $this->restResponseMock,
            $this->brandReader->findBrandByUuid($this->restRequestMock)
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByUuidWithNonExistingBrand(): void
    {
        $uuid = 'cf462b2e-42f6-11ec-81d3-0242ac130003';
        $filterFieldTransfers = new ArrayObject();

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($uuid);

        $this->restApiErrorMock->expects(static::never())
            ->method('addBrandUuidMissingError');

        $this->filterFieldsExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restRequestMock, static::callback(
                static function (ArrayObject $filterFieldTransfers) {
                    return $filterFieldTransfers->count() === 0;
                }
            ))->willReturn($filterFieldTransfers);

        $this->brandClientMock->expects(static::atLeastOnce())
            ->method('findBrands')
            ->with(
                static::callback(
                    static function (BrandListTransfer $brandListTransfer) use ($filterFieldTransfers) {
                        return $brandListTransfer->getFilterFields() === $filterFieldTransfers;
                    }
                )
            )->willReturn($this->brandListTransferMock);

        $this->brandListTransferMock->expects(static::atLeastOnce())
            ->method('getBrands')
            ->willReturn(new ArrayObject());

        $this->restApiErrorMock->expects(static::atLeastOnce())
            ->method('addBrandNotFoundError')
            ->with($this->restResponseMock)
            ->willReturn($this->restResponseMock);

        $this->brandMapperMock->expects(static::never())
            ->method('mapRestBrandsResponseAttributesTransfer');

        $this->restResourceBuilderMock->expects(static::never())
            ->method('createRestResource');

        $this->restResponseMock->expects(static::never())
            ->method('addResource');

        static::assertEquals(
            $this->restResponseMock,
            $this->brandReader->findBrandByUuid($this->restRequestMock)
        );
    }
}
