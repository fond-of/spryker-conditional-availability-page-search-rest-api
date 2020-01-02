<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi;

use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper\ConditionalAvailabilityPageSearchMapper;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper\ConditionalAvailabilityPageSearchMapperInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Reader\ConditionalAvailabilityPageSearchReader;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Reader\ConditionalAvailabilityPageSearchReaderInterface;
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
            $this->createConditionalAvailabilityPageSearchMapper()
        );
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface
     */
    protected function getConditionalAvailabilityPageSearchClient(): ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface
    {
        return $this->getProvidedDependency(
            ConditionalAvailabilityPageSearchRestApiDependencyProvider::CLIENT_CONDITIONAL_AVAILABILITY_PAGE_SEARCH
        );
    }

    /**
     * @return \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPeriod\Mapper\ConditionalAvailabilityPageSearchMapperInterface
     */
    protected function createConditionalAvailabilityPageSearchMapper(): ConditionalAvailabilityPageSearchMapperInterface
    {
        return new ConditionalAvailabilityPageSearchMapper();
    }
}
