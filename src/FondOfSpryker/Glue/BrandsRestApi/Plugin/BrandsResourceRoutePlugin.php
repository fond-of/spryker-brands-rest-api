<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Plugin;

use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use Generated\Shared\Transfer\RestBrandsRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class BrandsResourceRoutePlugin extends AbstractPlugin implements ResourceRoutePluginInterface
{
    /**
     * @api
     *
     * {@inheritdoc}
     *
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface $resourceRouteCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    public function configure(
        ResourceRouteCollectionInterface $resourceRouteCollection
    ): ResourceRouteCollectionInterface {
        $resourceRouteCollection
            ->addGet(BrandsRestApiConfig::ACTION_BRANDS_GET, true);

        return $resourceRouteCollection;
    }

    /**
     * @api
     *
     * {@inheritdoc}
     *
     * @return string
     */
    public function getResourceType(): string
    {
        return BrandsRestApiConfig::RESOURCE_BRANDS;
    }

    /**
     * @api
     *
     * {@inheritdoc}
     *
     * @return string
     */
    public function getController(): string
    {
        return BrandsRestApiConfig::CONTROLLER_BRANDS;
    }

    /**
     * @api
     *
     * {@inheritdoc}
     *
     * @return string
     */
    public function getResourceAttributesClassName(): string
    {
        return RestBrandsRequestAttributesTransfer::class;
    }
}
