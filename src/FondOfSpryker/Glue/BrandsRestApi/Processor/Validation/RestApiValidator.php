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
    public function isBrandAssignedToRestUser(
        BrandTransfer $brandTransfer,
        RestUserTransfer $restUserTransfer
    ): bool {
        return $this->isBrandAssignedToCustomer($brandTransfer, $restUserTransfer) ||
            $this->isBrandAssignedToCompany($brandTransfer, $restUserTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BrandTransfer $brandTransfer
     * @param \Generated\Shared\Transfer\RestUserTransfer $restUserTransfer
     *
     * @return bool
     */
    protected function isBrandAssignedToCustomer(
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
    protected function isBrandAssignedToCompany(
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
