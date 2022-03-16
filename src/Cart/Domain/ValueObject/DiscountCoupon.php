<?php

namespace Devkick\Cart\Domain\ValueObject;

class DiscountCoupon
{
    private string $discountCoupon;

    public function __construct(string $discountCoupon)
    {
        $this->discountCoupon = $discountCoupon;
    }

    /**
     * @return string
     */
    public function getDiscountCoupon(): string
    {
        return $this->discountCoupon;
    }
}
