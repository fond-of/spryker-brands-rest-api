<?php

namespace FondOfSpryker\Zed\BrandsRestApi;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class BrandsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const BRAND_FACADE = 'BRAND_FACADE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addBrandFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandFacade(Container $container): Container
    {
        $container[static::BRAND_FACADE] = static function (Container $container) {
            return $container->getLocator()->brand()->facade();
        };

        return $container;
    }
}
