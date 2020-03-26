<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Validation;

use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\RestUserTransfer;

class RestApiValidator implements RestApiValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     * @param \Generated\Shared\Transfer\RestUserTransfer $restUserTransfer
     *
     * @return bool
     */
    public function isBrandFromRestUser(
        BrandTransfer $brandTransfer,
        RestUserTransfer $restUserTransfer
    ): bool {
        return $this->isBrandFromRestUserCustomer($brandTransfer, $restUserTransfer) ||
            $this->isBrandFromRestUserCompany($brandTransfer, $restUserTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     * @param \Generated\Shared\Transfer\RestUserTransfer $restUserTransfer
     *
     * @return bool
     */
    protected function isBrandFromRestUserCustomer(
        BrandTransfer $brandTransfer,
        RestUserTransfer $restUserTransfer
    ): bool {
        if ($brandTransfer->getBrandCustomerRelation() === null) {
            return false;
        }

        $customerIds = $brandTransfer->getBrandCustomerRelation()->getCustomerIds();

        return in_array($restUserTransfer->getSurrogateIdentifier(), $customerIds, true);
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     * @param \Generated\Shared\Transfer\RestUserTransfer $restUserTransfer
     *
     * @return bool
     */
    protected function isBrandFromRestUserCompany(
        BrandTransfer $brandTransfer,
        RestUserTransfer $restUserTransfer
    ): bool {
        if ($brandTransfer->getBrandCompanyRelation() === null) {
            return false;
        }

        $companyIds = $brandTransfer->getBrandCompanyRelation()->getCompanyIds();

        return in_array($restUserTransfer->getIdCompany(), $companyIds, true);
    }
}
