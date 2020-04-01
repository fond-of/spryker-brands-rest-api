<?php

namespace FondOfSpryker\Client\BrandsRestApi\Zed;

use FondOfSpryker\Client\BrandsRestApi\Dependency\Client\BrandsRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;

class BrandsRestApiStub implements BrandsRestApiStubInterface
{
    /**
     * @var \FondOfSpryker\Client\BrandsRestApi\Dependency\Client\BrandsRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfSpryker\Client\BrandsRestApi\Dependency\Client\BrandsRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(BrandsRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function findBrandByUuid(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        /** @var \Generated\Shared\Transfer\BrandResponseTransfer $brandResponseTransfer */
        $brandResponseTransfer = $this->zedRequestClient->call('/brands-rest-api/gateway/find-brand-by-uuid', $brandTransfer);

        return $brandResponseTransfer;
    }
}
