<?php

namespace Devkick\CartWithAggregates\Domain\Discount\Repository;

use Devkick\CartWithAggregates\Domain\Discount\Discount;
use Devkick\CartWithAggregates\Domain\Discount\Event\DiscountEventInterface;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountCoupon;

interface DiscountRepositoryInterface
{
    public function getDiscountByCoupon(DiscountCoupon $discountCoupon): Discount;

    public function handleDiscount(DiscountEventInterface $discountEvent);
}
