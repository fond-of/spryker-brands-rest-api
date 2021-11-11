<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Dependency\Client;

use FondOfSpryker\Client\Brand\BrandClientInterface;
use Generated\Shared\Transfer\BrandListTransfer;

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
     * @param \Generated\Shared\Transfer\BrandListTransfer $brandListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandListTransfer
     */
    public function findBrands(BrandListTransfer $brandListTransfer): BrandListTransfer
    {
        return $this->brandClient->findBrands($brandListTransfer);
    }
}
