<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Dependency\Client;

use FondOfSpryker\Client\Brand\BrandClientInterface;
use Generated\Shared\Transfer\BrandCollectionTransfer;

class BrandsRestApiToBrandClientBridge implements BrandsRestApiToBrandClientInterface
{
    /**
     * @var \FondOfSpryker\Client\Brand\BrandClientInterface
     */
    protected $brandClient;

    /**
     * @param \FondOfSpryker\Client\Brand\BrandClientInterface $brandClient
     */
    public function __construct(BrandClientInterface $brandClient)
    {
        $this->brandClient = $brandClient;
    }

    /**
     * @return \Generated\Shared\Transfer\BrandCollectionTransfer
     */
    public function getActiveBrands(): BrandCollectionTransfer
    {
        return $this->brandClient->getActiveBrands();
    }
}
