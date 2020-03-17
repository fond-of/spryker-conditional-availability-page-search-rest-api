<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi;

use Codeception\Test\Unit;
use Spryker\Glue\Kernel\Container;

class ConditionalAvailabilityPageSearchRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\ConditionalAvailabilityPageSearchRestApiDependencyProvider
     */
    protected $conditionalAvailabilityPageSearchRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchRestApiDependencyProvider = new ConditionalAvailabilityPageSearchRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->conditionalAvailabilityPageSearchRestApiDependencyProvider->provideDependencies(
                $this->containerMock
            )
        );
    }
}
