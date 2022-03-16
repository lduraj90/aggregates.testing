<?php

namespace Devkick\CartWithAggregates\Application\Command;

use Devkick\CartWithAggregates\Domain\Cart\ValueObject\CartId;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountCoupon;

class ApplyDiscountCommand
{
    private DiscountCoupon $discountCoupon;

    public function __construct(DiscountCoupon $discountCoupon)
    {
        $this->discountCoupon = $discountCoupon;
    }

    public function getDiscountCoupon(): DiscountCoupon
    {
        return $this->discountCoupon;
    }
}
