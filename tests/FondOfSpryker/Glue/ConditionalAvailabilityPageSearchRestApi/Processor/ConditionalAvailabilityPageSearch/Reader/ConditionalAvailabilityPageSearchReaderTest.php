<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Reader;

use Codeception\Test\Unit;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\ConditionalAvailabilityPageSearchRestApiConfig;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper\ConditionalAvailabilityPageSearchMapperInterface;
use Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchPaginationTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\PageInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class ConditionalAvailabilityPageSearchReaderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Reader\ConditionalAvailabilityPageSearchReader
     */
    protected $conditionalAvailabilityPageSearchReader;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Client\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface
     */
    protected $conditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper\ConditionalAvailabilityPageSearchMapperInterface
     */
    protected $conditionalAvailabilityPageSearchMapperInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request
     */
    protected $requestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameterBagMock;

    /**
     * @var string
     */
    protected $requestParameter;

    /**
     * @var array
     */
    protected $allRequestParameters;

    /**
     * @var array
     */
    protected $searchResult;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer
     */
    protected $restConditionalAvailabilityPageSearchCollectionResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchPaginationTransfer
     */
    protected $restConditionalAvailabilityPageSearchPaginationTransferMock;

    /**
     * @var int
     */
    protected $numFound;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\PageInterface
     */
    protected $pageInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->restResourceBuilderInterfaceMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchMapperInterfaceMock = $this->getMockBuilder(ConditionalAvailabilityPageSearchMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestInterfaceMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->parameterBagMock = $this->getMockBuilder(ParameterBag::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->query = $this->parameterBagMock;

        $this->requestParameter = 'request-parameter';

        $this->allRequestParameters = [];

        $this->searchResult = [];

        $this->restConditionalAvailabilityPageSearchCollectionResponseTransferMock = $this->getMockBuilder(RestConditionalAvailabilityPageSearchCollectionResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceInterfaceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restConditionalAvailabilityPageSearchPaginationTransferMock = $this->getMockBuilder(RestConditionalAvailabilityPageSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->numFound = 1;

        $this->restResponseInterfaceMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pageInterfaceMock = $this->getMockBuilder(PageInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->conditionalAvailabilityPageSearchReader = new ConditionalAvailabilityPageSearchReader(
            $this->restResourceBuilderInterfaceMock,
            $this->conditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterfaceMock,
            $this->conditionalAvailabilityPageSearchMapperInterfaceMock
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->requestMock);

        $this->parameterBagMock->expects($this->atLeastOnce())
            ->method('all')
            ->willReturn($this->allRequestParameters);

        $this->parameterBagMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturn($this->requestParameter);

        $this->conditionalAvailabilityPageSearchRestApiToConditionalAvailabilityPageSearchClientInterfaceMock->expects($this->atLeastOnce())
            ->method('search')
            ->willReturn($this->searchResult);

        $this->conditionalAvailabilityPageSearchMapperInterfaceMock->expects($this->atLeastOnce())
            ->method('mapSearchResultToRestConditionalAvailabilityPageSearchCollectionResponseTransfer')
            ->with($this->searchResult)
            ->willReturn($this->restConditionalAvailabilityPageSearchCollectionResponseTransferMock);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResource')
            ->with(
                ConditionalAvailabilityPageSearchRestApiConfig::RESOURCE_CONDITIONAL_AVAILABILITY_PAGE_SEARCH,
                null,
                $this->restConditionalAvailabilityPageSearchCollectionResponseTransferMock
            )->willReturn($this->restResourceInterfaceMock);

        $this->restConditionalAvailabilityPageSearchCollectionResponseTransferMock->expects($this->atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->restConditionalAvailabilityPageSearchPaginationTransferMock);

        $this->restConditionalAvailabilityPageSearchPaginationTransferMock->expects($this->atLeastOnce())
            ->method('getNumFound')
            ->willReturn($this->numFound);

        $this->restResourceBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('createRestResponse')
            ->with($this->numFound)
            ->willReturn($this->restResponseInterfaceMock);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('getPage')
            ->willReturn(null);

        $this->restRequestInterfaceMock->expects($this->atLeastOnce())
            ->method('setPage')
            ->willReturnSelf();

        $this->restResponseInterfaceMock->expects($this->atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceInterfaceMock)
            ->willReturnSelf();

        $this->assertInstanceOf(
            RestResponseInterface::class,
            $this->conditionalAvailabilityPageSearchReader->get(
                $this->restRequestInterfaceMock
            )
        );
    }
}
