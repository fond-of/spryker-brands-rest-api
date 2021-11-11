<?php

namespace FondOfSpryker\Glue\BrandsRestApi;

use FondOfSpryker\Glue\BrandsRestApi\Dependency\Client\BrandsRestApiToBrandClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class BrandsRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_BRAND = 'CLIENT_BRAND';
    public const PLUGINS_FILTER_FIELDS_EXPANDER = 'PLUGINS_FILTER_FIELDS_EXPANDER';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addBrandClient($container);

        return $this->addFilterFieldsExpanderPlugins($container);
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addBrandClient(Container $container): Container
    {
        $container[static::CLIENT_BRAND] = static function (Container $container) {
            return new BrandsRestApiToBrandClientBridge($container->getLocator()->brand()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addFilterFieldsExpanderPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGINS_FILTER_FIELDS_EXPANDER] = static function () use ($self) {
            return $self->getFilterFieldsExpanderPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfOryx\Glue\BrandsRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface>
     */
    protected function getFilterFieldsExpanderPlugins(): array
    {
        return [];
    }
}
