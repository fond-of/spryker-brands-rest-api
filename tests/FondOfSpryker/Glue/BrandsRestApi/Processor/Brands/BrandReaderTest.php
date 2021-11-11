<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Brands;

use Codeception\Test\Unit;
use FondOfSpryker\Client\BrandsRestApi\BrandsRestApiClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface;
use FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiValidatorInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\RestBrandsResponseAttributesTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class BrandReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandReader
     */
    protected $brandReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientInterface
     */
    protected $brandsRestApiToBrandClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\BrandsRestApi\Processor\Brands\BrandMapperInterface
     */
    protected $brandMapperInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandCollectionTransfer
     */
    protected $brandCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandTransfer
     */
    protected $brandTransferMock;

    /**
     * @var array
     */
    protected $brandTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestBrandsResponseAttributesTransfer
     */
    protected $restBrandsResponseAttributesTransferMock;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\BrandsRestApi\BrandsRestApiClientInterface
     */
    protected $brandsRestApiClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiErrorInterface
     */
    protected $restApiErrorInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiValidatorInterface
     */
    protected $restApiValidatorInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestUserTransfer
     */
    protected $restUserTransferMock;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandResponseTransfer
     */
    protected $brandResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiToBrandClientInterfaceMock = $this->getMockBuilder(BrandsRestApiToBrandClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandMapperInterfaceMock = $this->getMockBuilder(BrandMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCollectionTransferMock = $this->getMockBuilder(BrandCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandTransferMocks = [
            $this->brandTransferMock,
        ];

        $this->restBrandsResponseAttributesTransferMock = $this->getMockBuilder(RestBrandsResponseAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uuid = 'uuid';

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsRestApiClientInterfaceMock = $this->getMockBuilder(BrandsRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiErrorInterfaceMock = $this->getMockBuilder(RestApiErrorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiValidatorInterfaceMock = $this->getMockBuilder(RestApiValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandResponseTransferMock = $this->getMockBuilder(BrandResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->id = 'id';

        $this->brandReader = new BrandReader(
            $this->restResourceBuilderInterfaceMock,
            $this->brandsRestApiToBrandClientInterfaceMock,
            $this->brandMapperInterfaceMock,
            $this->brandsRestApiClientInterfaceMock,
            $this->restApiErrorInterfaceMock,
            $this->restApiValidatorInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGetActiveBrands(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->brandsRestApiToBrandClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveBrands')
            ->willReturn($this->brandCollectionTransferMock);

        $this->brandCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getBrands')
            ->willReturn($this->brandTransferMocks);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restApiValidatorInterfaceMock->expects($this->atLeastOnce())
            ->method('isBrandAssignedToRestUser')
            ->with($this->brandTransferMock, $this->restUserTransferMock)
            ->willReturn(true);

        $this->brandMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapRestBrandsResponseAttributesTransfer')
            ->willReturn($this->restBrandsResponseAttributesTransferMock);

        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceInterfaceMock)
            ->willReturnSelf();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->brandReader->findBrands($this->restRequestInterfaceMock)
        );
    }

    /**
     * @return void
     */
    public function testGetActiveBrandsValidatorFail(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->brandsRestApiToBrandClientInterfaceMock->expects($this->atLeastOnce())
            ->method('getActiveBrands')
            ->willReturn($this->brandCollectionTransferMock);

        $this->brandCollectionTransferMock->expects($this->atLeastOnce())
            ->method('getBrands')
            ->willReturn($this->brandTransferMocks);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restApiValidatorInterfaceMock->expects($this->atLeastOnce())
            ->method('isBrandAssignedToRestUser')
            ->with($this->brandTransferMock, $this->restUserTransferMock)
            ->willReturn(false);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->brandReader->findBrands($this->restRequestInterfaceMock)
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByUuid(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->brandsRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findBrandByUuid')
            ->willReturn($this->brandResponseTransferMock);

        $this->brandResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->brandResponseTransferMock->expects($this->atLeastOnce())
            ->method('getBrand')
            ->willReturn($this->brandTransferMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restApiValidatorInterfaceMock->expects($this->atLeastOnce())
            ->method('isBrandAssignedToRestUser')
            ->with($this->brandTransferMock, $this->restUserTransferMock)
            ->willReturn(true);

        $this->brandMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapRestBrandsResponseAttributesTransfer')
            ->with($this->brandTransferMock)
            ->willReturn($this->restBrandsResponseAttributesTransferMock);

        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('getUuid')
            ->willReturn($this->uuid);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                BrandsRestApiConfig::RESOURCE_BRANDS,
                $this->uuid,
                $this->restBrandsResponseAttributesTransferMock
            )->willReturn($this->restResourceInterfaceMock);

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceInterfaceMock)
            ->willReturnSelf();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->brandReader->findBrandByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByUuidBrandUuidMissing(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn(null);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addBrandUuidMissingError')
            ->with($this->restResponseInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->brandReader->findBrandByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByUuidBrandNotFound(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->brandsRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findBrandByUuid')
            ->willReturn($this->brandResponseTransferMock);

        $this->brandResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addBrandNotFoundError')
            ->with($this->restResponseInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->brandReader->findBrandByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testFindBrandByUuidBrandNoPermission(): void
    {
        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceInterfaceMock);

        $this->restResourceInterfaceMock->expects($this->atLeastOnce())
            ->method('getId')
            ->willReturn($this->id);

        $this->brandsRestApiClientInterfaceMock->expects($this->atLeastOnce())
            ->method('findBrandByUuid')
            ->willReturn($this->brandResponseTransferMock);

        $this->brandResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->brandResponseTransferMock->expects($this->atLeastOnce())
            ->method('getBrand')
            ->willReturn($this->brandTransferMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restApiValidatorInterfaceMock->expects($this->atLeastOnce())
            ->method('isBrandAssignedToRestUser')
            ->with($this->brandTransferMock, $this->restUserTransferMock)
            ->willReturn(false);

        $this->restApiErrorInterfaceMock->expects($this->atLeastOnce())
            ->method('addBrandNoPermissionError')
            ->with($this->restResponseInterfaceMock)
            ->willReturn($this->restResponseInterfaceMock);

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->brandReader->findBrandByUuid(
                $this->restRequestInterfaceMock
            )
        );
    }
}
