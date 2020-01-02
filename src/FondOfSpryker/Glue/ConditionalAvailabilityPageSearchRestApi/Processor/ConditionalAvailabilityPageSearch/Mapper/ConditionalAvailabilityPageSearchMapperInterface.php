<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\ConditionalAvailabilityPageSearch\Mapper;

use Generated\Shared\Transfer\RestConditionalAvailabilityPageSearchCollectionResponseTransfer;

interface ConditionalAvailabilityPageSearchMapperInterface
{
    public function mapSearchResultToRestConditionalAvailabilityPageSearchCollectionResponseTransfer(
        array $searchResult
    ): RestConditionalAvailabilityPageSearchCollectionResponseTransfer;
}
