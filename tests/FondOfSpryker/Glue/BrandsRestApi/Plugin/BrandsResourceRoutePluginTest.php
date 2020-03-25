<?php

namespace FondOfSpryker\Glue\BrandsRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\BrandsRestApi\BrandsRestApiConfig;
use Generated\Shared\Transfer\RestBrandsRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class BrandsResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\BrandsRestApi\Plugin\BrandsResourceRoutePlugin
     */
    protected $brandsResourceRoutePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionInterfaceMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandsResourceRoutePlugin = new BrandsResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->assertInstanceOf(
            ResourceRouteCollectionInterface::class,
            $this->brandsResourceRoutePlugin->configure($this->resourceRouteCollectionInterfaceMock)
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertSame(BrandsRestApiConfig::RESOURCE_BRANDS, $this->brandsResourceRoutePlugin->getResourceType());
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(BrandsRestApiConfig::CONTROLLER_BRANDS, $this->brandsResourceRoutePlugin->getController());
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(RestBrandsRequestAttributesTransfer::class, $this->brandsResourceRoutePlugin->getResourceAttributesClassName());
    }
}
