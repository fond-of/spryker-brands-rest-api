<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Plugin;

use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipPluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiFactory getFactory()
 */
class BrandsCompanyUsersResourceRelationshipPlugin extends AbstractPlugin implements ResourceRelationshipPluginInterface
{
    /**
     * @api
     *
     * Specification:
     *  - Adds relationship to other resource, this method must connect relationships to given resources, current request object is given for more context.
     *
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface[] $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     */
    public function addResourceRelationships(array $resources, RestRequestInterface $restRequest): void
    {
        $this->getFactory()
            ->createBrandsResourceRelationshipExpander()
            ->addResourceRelationships($resources, $restRequest);
    }

    /**
     * @api
     *
     * Specification:
     *  - Related resource name, when adding relationship e.g items have products, then this will have products literal
     *
     * @return string
     */
    public function getRelationshipResourceType(): string
    {
        return BrandsRestApiConfig::RESOURCE_BRANDS;
    }
}
