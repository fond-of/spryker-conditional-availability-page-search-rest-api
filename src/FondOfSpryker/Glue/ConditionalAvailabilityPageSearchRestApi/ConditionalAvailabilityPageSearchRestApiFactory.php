<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi;

use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Service\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper\ConditionalAvailabilityPageSearchMapper;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper\ConditionalAvailabilityPageSearchMapperInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Reader\ConditionalAvailabilityPageSearchReader;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Reader\ConditionalAvailabilityPageSearchReaderInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\EarliestDeliveryDate\Generator\EarliestDeliveryDateGenerator;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\EarliestDeliveryDate\Generator\EarliestDeliveryDateGeneratorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class ConditionalAvailabilityPageSearchRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Reader\ConditionalAvailabilityPageSearchReaderInterface
     */
    public function createConditionalAvailabilityPageSearchReader(): ConditionalAvailabilityPageSearchReaderInterface
    {
        return new ConditionalAvailabilityPageSearchReader(
            $this->getResourceBuilder(),
            $this->getConditionalAvailabilityPageSearchClient(),
            $this->createConditionalAvailabilityPageSearchMapper(),
        );
    }

    /**
     * @return \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface
     */
    protected function getConditionalAvailabilityPageSearchClient(): ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityPageSearchRestApiDependencyProvider::CLIENT_CONDITIONAL_AVAILABILITY_PAGE_SEARCH,
        );
    }

    /**
     * @return \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper\ConditionalAvailabilityPageSearchMapperInterface
     */
    protected function createConditionalAvailabilityPageSearchMapper(): ConditionalAvailabilityPageSearchMapperInterface
    {
        return new ConditionalAvailabilityPageSearchMapper(
            $this->getRestConditionalAvailabilityPeriodMapperPlugins(),
        );
    }

    /**
     * @return array<\FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApiExtension\Dependency\Plugin\RestConditionalAvailabilityPeriodMapperPluginInterface>
     */
    protected function getRestConditionalAvailabilityPeriodMapperPlugins(): array
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityPageSearchRestApiDependencyProvider::PLUGIN_REST_CONDITIONAL_AVAILABILITY_PERIOD_MAPPER,
        );
    }

    /**
     * @return \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Service\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceInterface
     */
    protected function getConditionalAvailabilityService(): ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceInterface
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityPageSearchRestApiDependencyProvider::SERVICE_CONDITIONAL_AVAILABILITY,
        );
    }

    /**
     * @return \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\EarliestDeliveryDate\Generator\EarliestDeliveryDateGeneratorInterface
     */
    public function createEarliestDeliveryDateGenerator(): EarliestDeliveryDateGeneratorInterface
    {
        return new EarliestDeliveryDateGenerator(
            $this->getConditionalAvailabilityService(),
        );
    }
}
