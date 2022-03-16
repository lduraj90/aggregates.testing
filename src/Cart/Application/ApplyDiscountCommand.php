<?php

namespace Devkick\Cart\Application;

use Devkick\Cart\Domain\ValueObject\DiscountCoupon;

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
