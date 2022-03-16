<?php

namespace Devkick\CartWithAggregates\Application;

use Devkick\CartWithAggregates\Application\Command\ApplyDiscountCommand;
use Devkick\CartWithAggregates\Application\IntegrationEvent\DiscountFailedEvent;
use Devkick\CartWithAggregates\Domain\Discount\Exception\DiscountCouponNotExists;
use Devkick\CartWithAggregates\Domain\Discount\Repository\DiscountRepositoryInterface;

class DiscountService
{
    private DiscountRepositoryInterface $discountRepository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        DiscountRepositoryInterface $discountRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->discountRepository = $discountRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function applyDiscountHandler(ApplyDiscountCommand $applyDiscountCommand): void
    {
        try {
            $discount = $this->discountRepository->getDiscountByCoupon($applyDiscountCommand->getDiscountCoupon());

            $discountEvent = $discount->useDiscount();

            $this->discountRepository->handleDiscount($discountEvent);
            $this->eventDispatcher->dispatch($discountEvent);
        } catch (DiscountCouponNotExists $e) {
            $this->eventDispatcher->dispatch(new DiscountFailedEvent());
        }
    }
}
