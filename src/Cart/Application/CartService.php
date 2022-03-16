<?php

namespace Devkick\Cart\Application;

use Devkick\Cart\Domain\Event\DiscountApplySuccessEvent;
use Devkick\Cart\Domain\Exception\CartNotExists;
use Devkick\Cart\Domain\Repository\CartRepositoryInterface;
use Devkick\Cart\Domain\Event\DiscountApplyFailedEvent;
use Devkick\Cart\Domain\Exception\DiscountCannotBeApplied;
use Devkick\Cart\Domain\Exception\DiscountCouponNotExists;
use Devkick\Cart\Domain\Repository\DiscountRepositoryInterface;

class CartService
{
    private CartRepositoryInterface $cartRepository;
    private DiscountRepositoryInterface $discountRepository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        DiscountRepositoryInterface $discountRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->cartRepository = $cartRepository;
        $this->discountRepository = $discountRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function applyDiscountHandler(ApplyDiscountCommand $applyDiscountCommand): void
    {
        try {
            $cart = $this->cartRepository->getCart();
            $discount = $this->discountRepository->getDiscountByCoupon($applyDiscountCommand->getDiscountCoupon());

            if ($discount->isExpired()) {
                throw new DiscountCannotBeApplied();
            }

            if ($discount->applyOnlyToTheThirdProduct()) {
                $cart->calculateOnlyThirdProductDiscount($discount->getDiscountPercentage());
            }

            if ($discount->applyToAllProducts()) {
                $cart->calculateForAllProducts($discount->getDiscountPercentage());
            }

            $this->discountRepository->disableDiscountCoupon($applyDiscountCommand->getDiscountCoupon());
            $this->cartRepository->saveCart($cart);
            $this->eventDispatcher->dispatch(new DiscountApplySuccessEvent());

        } catch (CartNotExists | DiscountCouponNotExists | DiscountCannotBeApplied $e) {
            $this->eventDispatcher->dispatch(new DiscountApplyFailedEvent());
        }
    }
}
