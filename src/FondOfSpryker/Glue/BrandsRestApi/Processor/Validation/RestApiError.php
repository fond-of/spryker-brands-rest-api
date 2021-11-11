<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Validation;

use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestApiError implements RestApiErrorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addBrandUuidMissingError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(BrandsRestApiConfig::RESPONSE_CODE_UUID_MISSING)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(BrandsRestApiConfig::RESPONSE_DETAILS_UUID_MISSING);

        return $restResponse->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addBrandNotFoundError(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(BrandsRestApiConfig::RESPONSE_CODE_BRAND_NOT_FOUND)
            ->setStatus(Response::HTTP_NOT_FOUND)
            ->setDetail(BrandsRestApiConfig::RESPONSE_DETAILS_BRAND_NOT_FOUND);

        return $restResponse->addError($restErrorMessageTransfer);
    }
}
