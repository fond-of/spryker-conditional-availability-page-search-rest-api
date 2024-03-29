<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchClientInterface;

class ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientBridge
     */
    protected $conditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Client\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchClientInterface
     */
    protected $conditionalAvailabilityPageSearchClientInterfaceMock;

    /**
     * @var string
     */
    protected $searchString;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->conditionalAvailabilityPageSearchClientInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchString = 'search-string';

        $this->conditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientBridge = new ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientBridge(
            $this->conditionalAvailabilityPageSearchClientInterfaceMock,
        );
    }

    /**
     * @return void
     */
    public function testSearch(): void
    {
        $this->conditionalAvailabilityPageSearchClientInterfaceMock->expects($this->atLeastOnce())
            ->method('search')
            ->with($this->searchString, [])
            ->willReturn([]);

        $this->assertIsArray(
            $this->conditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientBridge->search(
                $this->searchString,
            ),
        );
    }
}
