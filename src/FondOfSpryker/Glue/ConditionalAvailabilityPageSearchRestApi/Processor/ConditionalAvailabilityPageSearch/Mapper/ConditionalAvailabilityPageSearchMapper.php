<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper;

use Generated\Shared\Transfer\FacetConfigTransfer;
use Generated\Shared\Transfer\FacetSearchResultTransfer;
use Generated\Shared\Transfer\RangeSearchResultTransfer;
use Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer;
use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodTransfer;
use Generated\Shared\Transfer\RestFacetConfigTransfer;
use Generated\Shared\Transfer\RestFacetSearchResultTransfer;
use Generated\Shared\Transfer\RestRangeSearchResultTransfer;

class ConditionalAvailabilityPageSearchMapper implements ConditionalAvailabilityPageSearchMapperInterface
{
    protected const SEARCH_RESULT_KEY_PERIODS = 'periods';
    protected const SEARCH_RESULT_KEY_FACETS = 'facets';

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

        $restConditionalAvailabilityPeriodCollectionResponseTransfer = $this->mapSearchResultToRestFacetAndRestRangeSearchResultTransfers(
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

    /**
     * @param array $searchResult
     * @param \Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer $restConditionalAvailabilityPeriodCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer
     */
    protected function mapSearchResultToRestFacetAndRestRangeSearchResultTransfers(
        array $searchResult,
        RestConditionalAvailabilityPageSearchCollectionResponseTransfer $restConditionalAvailabilityPeriodCollectionResponseTransfer
    ): RestConditionalAvailabilityPageSearchCollectionResponseTransfer {
        if (!isset($searchResult[static::SEARCH_RESULT_KEY_FACETS])) {
            return $restConditionalAvailabilityPeriodCollectionResponseTransfer;
        }

        foreach ($searchResult[static::SEARCH_RESULT_KEY_FACETS] as $facet) {
            if ($facet instanceof FacetSearchResultTransfer) {
                $restConditionalAvailabilityPeriodCollectionResponseTransfer = $this->mapFacetSearchResultTransferToRestFacetSearchResultTransfer(
                    $facet,
                    $restConditionalAvailabilityPeriodCollectionResponseTransfer
                );
            }

            if ($facet instanceof RangeSearchResultTransfer) {
                $restConditionalAvailabilityPeriodCollectionResponseTransfer = $this->mapRangeSearchResultTransferToRestRangeSearchResultTransfer(
                    $facet,
                    $restConditionalAvailabilityPeriodCollectionResponseTransfer
                );
            }
        }

        return $restConditionalAvailabilityPeriodCollectionResponseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\FacetSearchResultTransfer $facetSearchResultTransfer
     * @param \Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer $restConditionalAvailabilityPeriodCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer
     */
    protected function mapFacetSearchResultTransferToRestFacetSearchResultTransfer(
        FacetSearchResultTransfer $facetSearchResultTransfer,
        RestConditionalAvailabilityPageSearchCollectionResponseTransfer $restConditionalAvailabilityPeriodCollectionResponseTransfer
    ): RestConditionalAvailabilityPageSearchCollectionResponseTransfer {
        $restFacetSearchResultTransfer = (new RestFacetSearchResultTransfer())
            ->fromArray($facetSearchResultTransfer->toArray(), true)
            ->setConfig($this->mapFacetConfigTransferToRestFacetConfigTransfer($facetSearchResultTransfer->getConfig()));

        return $restConditionalAvailabilityPeriodCollectionResponseTransfer
            ->addValueFacet($restFacetSearchResultTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RangeSearchResultTransfer $rangeSearchResultTransfer
     * @param \Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer $restConditionalAvailabilityPeriodCollectionResponseTransfer
     *
     * @return \Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer
     */
    protected function mapRangeSearchResultTransferToRestRangeSearchResultTransfer(
        RangeSearchResultTransfer $rangeSearchResultTransfer,
        RestConditionalAvailabilityPageSearchCollectionResponseTransfer $restConditionalAvailabilityPeriodCollectionResponseTransfer
    ): RestConditionalAvailabilityPageSearchCollectionResponseTransfer {
        $restRangeSearchResultTransfer = (new RestRangeSearchResultTransfer())
            ->fromArray($rangeSearchResultTransfer->toArray(), true)
            ->setConfig($this->mapFacetConfigTransferToRestFacetConfigTransfer($rangeSearchResultTransfer->getConfig()));

        return $restConditionalAvailabilityPeriodCollectionResponseTransfer
            ->addRangeFacet($restRangeSearchResultTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FacetConfigTransfer $facetConfigTransfer
     *
     * @return \Generated\Shared\Transfer\RestFacetConfigTransfer
     */
    protected function mapFacetConfigTransferToRestFacetConfigTransfer(
        FacetConfigTransfer $facetConfigTransfer
    ): RestFacetConfigTransfer {
        $restFacetConfigTransfer = (new RestFacetConfigTransfer())->fromArray($facetConfigTransfer->toArray(), true);
        $restFacetConfigTransfer->setIsMultiValued((bool)$restFacetConfigTransfer->getIsMultiValued());

        return $restFacetConfigTransfer;
    }
}
