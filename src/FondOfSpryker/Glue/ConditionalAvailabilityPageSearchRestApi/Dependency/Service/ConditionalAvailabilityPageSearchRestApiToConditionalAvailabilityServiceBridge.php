<?php

namespace FondOfSpryker\Glue\ConditionalAvailabilityPageSearchRestApi\Dependency\Service;

use DateTime;
use DateTimeInterface;
use FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityServiceInterface;

class ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceBridge implements
    ConditionalAvailabilityPageSearchRestApiToConditionalAvailabilityServiceInterface
{
    /**
     * @var \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityServiceInterface
     */
    protected $conditionalAvailabilityService;

    /**
     * @param \FondOfSpryker\Service\ConditionalAvailability\ConditionalAvailabilityServiceInterface $conditionalAvailabilityService
     */
    public function __construct(ConditionalAvailabilityServiceInterface $conditionalAvailabilityService)
    {
        $this->conditionalAvailabilityService = $conditionalAvailabilityService;
    }

    /**
     * @param \DateTime $dateTime
     *
     * @return \DateTimeInterface
     */
    public function generateEarliestDeliveryDateByDateTime(DateTime $dateTime): DateTimeInterface
    {
        return $this->conditionalAvailabilityService->generateEarliestDeliveryDateByDateTime($dateTime);
    }
}
