<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Processor\Validation;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\BrandCompanyRelationTransfer;
use Generated\Shared\Transfer\BrandCustomerRelationTransfer;
use Generated\Shared\Transfer\BrandTransfer;
use Generated\Shared\Transfer\RestUserTransfer;

class RestApiValidatorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Processor\Validation\RestApiValidator
     */
    protected $restApiValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandTransfer
     */
    protected $brandTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestUserTransfer
     */
    protected $restUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandCustomerRelationTransfer
     */
    protected $brandCustomerRelationTransferMock;

    /**
     * @var int[]
     */
    protected $customerIds;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\BrandCompanyRelationTransfer
     */
    protected $brandCompanyRelationTransferMock;

    /**
     * @var int
     */
    protected $customerId;

    /**
     * @var int
     */
    protected $companyId;

    /**
     * @var int[]
     */
    protected $companyIds;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->brandTransferMock = $this->getMockBuilder(BrandTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCustomerRelationTransferMock = $this->getMockBuilder(BrandCustomerRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerId = 1;

        $this->customerIds = [$this->customerId, 2];

        $this->brandCompanyRelationTransferMock = $this->getMockBuilder(BrandCompanyRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyId = 3;

        $this->companyIds = [$this->companyId, 4];

        $this->restApiValidator = new RestApiValidator();
    }

    /**
     * @return void
     */
    public function testIsBrandAssignedToRestUser(): void
    {
        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('getBrandCustomerRelation')
            ->willReturn($this->brandCustomerRelationTransferMock);

        $this->brandCustomerRelationTransferMock->expects($this->atLeastOnce())
            ->method('getCustomerIds')
            ->willReturn($this->customerIds);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn(99);

        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('getBrandCompanyRelation')
            ->willReturn($this->brandCompanyRelationTransferMock);

        $this->brandCompanyRelationTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyIds')
            ->willReturn($this->companyIds);

        $this->restUserTransferMock->expects($this->atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($this->companyId);

        $this->assertTrue(
            $this->restApiValidator->isBrandAssignedToRestUser(
                $this->brandTransferMock,
                $this->restUserTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testIsBrandAssignedToRestUserBrandRelationsNull(): void
    {
        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('getBrandCustomerRelation')
            ->willReturn(null);

        $this->brandTransferMock->expects($this->atLeastOnce())
            ->method('getBrandCompanyRelation')
            ->willReturn(null);

        $this->assertFalse(
            $this->restApiValidator->isBrandAssignedToRestUser(
                $this->brandTransferMock,
                $this->restUserTransferMock
            )
        );
    }
}
