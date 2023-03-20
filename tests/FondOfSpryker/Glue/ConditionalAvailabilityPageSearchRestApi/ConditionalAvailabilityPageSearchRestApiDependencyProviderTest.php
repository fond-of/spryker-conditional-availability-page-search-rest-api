<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchClientInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Service\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceInterface;
use FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityServiceInterface;
use Spryker\Glue\Kernel\Container;
use Spryker\Glue\Kernel\Locator;
use Spryker\Shared\Kernel\BundleProxy;

class ConditionalAvailabilityPageSearchRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \FondOfSpryker\Client\ConditionalAvailabilityPageSearch\ConditionalAvailabilityPageSearchClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $conditionalAvailabilityPageSearchClientMock;

    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $conditionalAvailabilityServiceMock;

    /**
     * @var \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\ConditionalAvailabilityPageSearchRestApiDependencyProvider
     */
    protected $conditionalAvailabilityPageSearchRestApiDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet', 'has', 'offsetExists'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchClientMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityServiceMock = $this->getMockBuilder(ConditionalAvailabilityServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchRestApiDependencyProvider = new ConditionalAvailabilityPageSearchRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['conditionalAvailabilityPageSearch'], ['conditionalAvailability'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['client'], ['service'])
            ->willReturnOnConsecutiveCalls(
                $this->conditionalAvailabilityPageSearchClientMock,
                $this->conditionalAvailabilityServiceMock,
            );

        $container = $this->conditionalAvailabilityPageSearchRestApiDependencyProvider->provideDependencies(
            $this->containerMock,
        );

        static::assertInstanceOf(
            ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface::class,
            $container[ConditionalAvailabilityPageSearchRestApiDependencyProvider::CLIENT_CONDITIONAL_AVAILABILITY_PAGE_SEARCH],
        );

        static::assertInstanceOf(
            ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceInterface::class,
            $container[ConditionalAvailabilityPageSearchRestApiDependencyProvider::SERVICE_CONDITIONAL_AVAILABILITY],
        );

        static::assertCount(
            0,
            $container[ConditionalAvailabilityPageSearchRestApiDependencyProvider::PLUGIN_REST_CONDITIONAL_AVAILABILITY_PERIOD_MAPPER],
        );
    }
}
