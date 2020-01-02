<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi;

use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;

class ConditionalAvailabilityPageSearchRestApiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_CONDITIONAL_AVAILABILITY_PAGE_SEARCH = 'CLIENT_CONDITIONAL_AVAILABILITY_PAGE_SEARCH';

    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    public function provideDependencies(Container $container): Container
    {
        $container = parent::provideDependencies($container);

        $container = $this->addConditionalAvailabilityPageSearchClient($container);

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
                $container->getLocator()->conditionalAvailabilityPageSearch()->client()
            );
        };

        return $container;
    }
}
