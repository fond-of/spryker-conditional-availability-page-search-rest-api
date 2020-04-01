<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer;

class ConditionalAvailabilityPageSearchMapperTest extends Unit
{
    /**
     * @var \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper\ConditionalAvailabilityPageSearchMapper
     */
    protected $conditionalAvailabilityPageSearchMapper;

    /**
     * @var array
     */
    protected $searchResult;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->searchResult = [
            'periods' => [
                [
                    'quantity' => 12,
                ],
            ],
        ];

        $this->conditionalAvailabilityPageSearchMapper = new ConditionalAvailabilityPageSearchMapper();
    }

    /**
     * @return void
     */
    public function testMapSearchResultToRestConditionalAvailabilityPageSearchCollectionResponseTransfer(): void
    {
        $this->assertInstanceOf(
            RestConditionalAvailabilityPageSearchCollectionResponseTransfer::class,
            $this->conditionalAvailabilityPageSearchMapper->mapSearchResultToRestConditionalAvailabilityPageSearchCollectionResponseTransfer(
                $this->searchResult
            )
        );
    }

    /**
     * @return void
     */
    public function testMapSearchResultToRestConditionalAvailabilityPageSearchCollectionResponseTransferEmpty(): void
    {
        $this->assertInstanceOf(
            RestConditionalAvailabilityPageSearchCollectionResponseTransfer::class,
            $this->conditionalAvailabilityPageSearchMapper->mapSearchResultToRestConditionalAvailabilityPageSearchCollectionResponseTransfer(
                []
            )
        );
    }
}
