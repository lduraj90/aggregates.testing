<?php

namespace Devkick\Cart\Domain\Repository;

use Devkick\Cart\Domain\Entity\Discount;
use Devkick\Cart\Domain\ValueObject\DiscountCoupon;

interface DiscountRepositoryInterface
{
    public function getDiscountByCoupon(DiscountCoupon $discountCoupon): Discount;

    public function disableDiscountCoupon(DiscountCoupon $discountCoupon): void;
}
