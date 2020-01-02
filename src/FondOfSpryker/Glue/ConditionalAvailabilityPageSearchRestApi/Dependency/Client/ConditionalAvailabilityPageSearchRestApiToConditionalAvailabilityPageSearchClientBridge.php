<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client;

use FondOfSpryker\Client\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchClientInterface;

class ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientBridge implements ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface
{
    /**
     * @var \FondOfSpryker\Client\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchClientInterface
     */
    protected $conditionalAvailabilityPageSearchClient;

    /**
     * @param \FondOfSpryker\Client\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchClientInterface $conditionalAvailabilityPageSearchClient
     */
    public function __construct(
        ConditionalAvailabilityPageSearchClientInterface $conditionalAvailabilityPageSearchClient
    ) {
        $this->conditionalAvailabilityPageSearchClient = $conditionalAvailabilityPageSearchClient;
    }

    /**
     * @param string $searchString
     * @param array $requestParameters
     *
     * @return array
     */
    public function search(string $searchString, array $requestParameters = []): array
    {
        return $this->conditionalAvailabilityPageSearchClient->search($searchString, $requestParameters);
    }
}
