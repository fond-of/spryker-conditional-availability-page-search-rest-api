<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper;

use Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodTransfer;

class ConditionalAvailabilityPageSearchMapper implements ConditionalAvailabilityPageSearchMapperInterface
{
    protected const SEARCH_RESULT_KEY_PERIODS = 'periods';

    /**
     * @param array $searchResult
     *
     * @return \Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer
     */
    public function mapSearchResultToRestConditionalAvailabilityPageSearchCollectionResponseTransfer(
        array $searchResult
    ): RestConditionalAvailabilityPageSearchCollectionResponseTransfer {
        $restConditionalAvailabilityPeriodCollectionResponseTransfer = (new RestConditionalAvailabilityPageSearchCollectionResponseTransfer())
            ->fromArray($searchResult, true);

        $restConditionalAvailabilityPeriodCollectionResponseTransfer = $this->mapSearchResultToRestConditionalAvailabilityPeriodTransfers(
            $searchResult,
            $restConditionalAvailabilityPeriodCollectionResponseTransfer
        );

        return $restConditionalAvailabilityPeriodCollectionResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer|array $restConditionalAvailabilityPeriodCollectionResponseTransfer
     * @param array $restSearchResponse
     *
     * @return \Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer
     */
    protected function mapSearchResultToRestConditionalAvailabilityPeriodTransfers(
        array $restSearchResponse,
        RestConditionalAvailabilityPageSearchCollectionResponseTransfer $restConditionalAvailabilityPeriodCollectionResponseTransfer
    ): RestConditionalAvailabilityPageSearchCollectionResponseTransfer {
        if (!isset($restSearchResponse[static::SEARCH_RESULT_KEY_PERIODS])
            || !is_array($restSearchResponse[static::SEARCH_RESULT_KEY_PERIODS])
        ) {
            return $restConditionalAvailabilityPeriodCollectionResponseTransfer;
        }

        foreach ($restSearchResponse[static::SEARCH_RESULT_KEY_PERIODS] as $period) {
            $restConditionalAvailabilityPeriodTransfer = (new RestConditionalAvailabilityPeriodTransfer())
                ->fromArray($period, true);

            if (isset($period['quantity'])) {
                $restConditionalAvailabilityPeriodTransfer->setQty($period['quantity']);
            }

            $restConditionalAvailabilityPeriodCollectionResponseTransfer->addConditionalAvailabilityPeriods(
                $restConditionalAvailabilityPeriodTransfer
            );
        }

        return $restConditionalAvailabilityPeriodCollectionResponseTransfer;
    }
}
