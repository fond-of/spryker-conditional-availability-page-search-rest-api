<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Processor\EarliestDeliveryDate\Generator;

use DateTime;
use DateTimeInterface;
use FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Service\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceInterface;
use Generated\Shared\Transfer\RestConditionalAvailabilityPeriodTransfer;

class EarliestDeliveryDateGenerator implements EarliestDeliveryDateGeneratorInterface
{
    /**
     * @var \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Service\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceInterface
     */
    protected $conditionalAvailabilityService;

    /**
     * @param \FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Service\ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceInterface $conditionalAvailabilityService
     */
    public function __construct(
        ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceInterface $conditionalAvailabilityService
    ) {
        $this->conditionalAvailabilityService = $conditionalAvailabilityService;
    }

    /**
     * @param \Generated\Shared\Transfer\RestConditionalAvailabilityPeriodTransfer $restConditionalAvailabilityPeriodTransfer
     *
     * @return \DateTimeInterface|null
     */
    public function generateByRestConditionalAvailabilityPeriodTransfer(
        RestConditionalAvailabilityPeriodTransfer $restConditionalAvailabilityPeriodTransfer
    ): ?DateTimeInterface {
        $startAt = $restConditionalAvailabilityPeriodTransfer->getStartAt();
        $endAt = $restConditionalAvailabilityPeriodTransfer->getEndAt();

        if ($startAt === null || $endAt === null) {
            return null;
        }

        $today = (new DateTime())->setTime(0, 0);
        $latestAvailabilityDate = new DateTime($endAt);

        if ($today > $latestAvailabilityDate) {
            return null;
        }

        $earliestAvailabilityDate = new DateTime($startAt);

        if ($today > $earliestAvailabilityDate) {
            $earliestAvailabilityDate = $today;
        }

        return $this->conditionalAvailabilityService->generateEarliestDeliveryDateByDateTime($earliestAvailabilityDate);
    }
}
