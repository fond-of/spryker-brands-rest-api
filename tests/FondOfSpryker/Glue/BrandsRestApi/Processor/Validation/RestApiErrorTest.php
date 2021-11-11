<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Validation;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestApiErrorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiError
     */
    protected $restApiError;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restApiError = new RestApiError();
    }

    /**
     * @return void
     */
    public function testAddBrandUuidMissingError(): void
    {
        $this->restResponseInterfaceMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === BrandsRestApiConfig::RESPONSE_CODE_UUID_MISSING
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_BAD_REQUEST
                            && $restErrorMessageTransfer->getDetail() === BrandsRestApiConfig::RESPONSE_DETAILS_UUID_MISSING;
                    }
                )
            )->willReturn($this->restResponseInterfaceMock);

        static::assertEquals(
            $this->restResponseInterfaceMock,
            $this->restApiError->addBrandUuidMissingError(
                $this->restResponseInterfaceMock
            )
        );
    }

    /**
     * @return void
     */
    public function testAddBrandNotFoundError(): void
    {
        $this->restResponseInterfaceMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === BrandsRestApiConfig::RESPONSE_CODE_BRAND_NOT_FOUND
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_NOT_FOUND
                            && $restErrorMessageTransfer->getDetail() === BrandsRestApiConfig::RESPONSE_DETAILS_BRAND_NOT_FOUND;
                    }
                )
            )->willReturn($this->restResponseInterfaceMock);

        static::assertEquals(
            $this->restResponseInterfaceMock,
            $this->restApiError->addBrandNotFoundError(
                $this->restResponseInterfaceMock
            )
        );
    }
}
