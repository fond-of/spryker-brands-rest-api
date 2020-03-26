<?php

namespace FondOfSpryker\Client\BrandsRestApi;

use Generated\Shared\Transfer\BrandResponseTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfSpryker\Client\BrandsRestApi\BrandsRestApiFactory getFactory()
 */
class BrandsRestApiClient extends AbstractClient implements BrandsRestApiClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * {@internal will work if UUID field is provided.}
     *
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     *
     * @return \Generated\Shared\Transfer\BrandResponseTransfer
     */
    public function findBrandByUuid(BrandTransfer $brandTransfer): BrandResponseTransfer
    {
        return $this->getFactory()
            ->createZedBrandsRestApiStub()
            ->findBrandByUuid($brandTransfer);
    }
}
