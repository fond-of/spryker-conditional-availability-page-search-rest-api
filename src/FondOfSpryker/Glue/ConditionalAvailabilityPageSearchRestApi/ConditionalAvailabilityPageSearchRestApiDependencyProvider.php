<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi;

use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientBridge;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Service\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class ConditionalAvailabilityPageSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const CLIENT_CONDITIONAL_AVAILABILITY_PAGE_SEARCH = 'CLIENT_CONDITIONAL_AVAILABILITY_PAGE_SEARCH';

    /**
     * @var string
     */
    public const PLUGIN_REST_CONDITIONAL_AVAILABILITY_PERIOD_MAPPER = 'PLUGIN_REST_CONDITIONAL_AVAILABILITY_PERIOD_MAPPER';

    /**
     * @var string
     */
    public const SERVICE_CONDITIONAL_AVAILABILITY = 'SERVICE_CONDITIONAL_AVAILABILITY';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addConditionalAvailabilityPageSearchClient($container);
        $container = $this->addRestConditionalAvailabilityPeriodMapperPlugins($container);
        $container = $this->addConditionalAvailabilityService($container);

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addConditionalAvailabilityPageSearchClient(Container $container): Container
    {
        $container[static::CLIENT_CONDITIONAL_AVAILABILITY_PAGE_SEARCH] = static function (Container $container) {
            return new ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientBridge(
                $container->getLocator()->conditionalAvailabilityPageSearch()->client(),
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addRestConditionalAvailabilityPeriodMapperPlugins(Container $container): Container
    {
        $self = $this;

        $container[static::PLUGIN_REST_CONDITIONAL_AVAILABILITY_PERIOD_MAPPER] = static function () use ($self) {
            return $self->getRestConditionalAvailabilityPeriodMapperPlugins();
        };

        return $container;
    }

    /**
     * @return array<\FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApiExtension\Dependency\Plugin\RestConditionalAvailabilityPeriodMapperPluginInterface>
     */
    protected function getRestConditionalAvailabilityPeriodMapperPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addConditionalAvailabilityService(Container $container): Container
    {
        $container[static::SERVICE_CONDITIONAL_AVAILABILITY] = static function (Container $container) {
            return new ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceBridge(
                $container->getLocator()->conditionalAvailability()->service(),
            );
        };

        return $container;
    }
}
