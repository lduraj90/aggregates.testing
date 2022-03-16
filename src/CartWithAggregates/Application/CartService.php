<?php

namespace Devkick\CartWithAggregates\Application;

use Devkick\CartWithAggregates\Application\IntegrationEvent\DiscountFailedEvent;
use Devkick\CartWithAggregates\Domain\Cart\Exception\CartNotExists;
use Devkick\CartWithAggregates\Domain\Cart\Repository\CartRepositoryInterface;
use Devkick\CartWithAggregates\Domain\Discount\Event\DiscountCouponUsedEvent;

class CartService
{
    private CartRepositoryInterface $cartRepository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->cartRepository = $cartRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function applyDiscountHandler(DiscountCouponUsedEvent $discountUsedEvent): void
    {
        try {
            $cart = $this->cartRepository->getCart();

            $cartEvent = $cart->applyDiscount(
                $discountUsedEvent->getDiscountPercentage(),
                $discountUsedEvent->getDiscountType()
            );

            $this->cartRepository->handleCartEvent($cartEvent);
            $this->eventDispatcher->dispatch($cartEvent);

        } catch (CartNotExists $e) {
            $this->eventDispatcher->dispatch(new DiscountFailedEvent());
        }
    }
}
