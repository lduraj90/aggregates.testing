<?php

namespace Devkick\Cart\Domain\Entity;

use Devkick\Cart\Domain\ValueObject\DiscountCoupon;
use Devkick\Cart\Domain\ValueObject\DiscountExpirationDate;
use Devkick\Cart\Domain\ValueObject\DiscountId;
use Devkick\Cart\Domain\ValueObject\DiscountPercentage;
use Devkick\Cart\Domain\ValueObject\DiscountType;

class Discount
{
    private DiscountExpirationDate $discountExpirationDate;
    private DiscountType $discountType;
    private DiscountPercentage $discountPercentage;
    private DiscountCoupon $discountCoupon;
    private DiscountId $id;

    public function __construct(
        DiscountExpirationDate $discountExpirationDate,
        DiscountType $discountType,
        DiscountPercentage $discountPercentage,
        DiscountCoupon $discountCoupon,
        DiscountId $id
    ) {
        $this->discountExpirationDate = $discountExpirationDate;
        $this->discountType = $discountType;
        $this->discountPercentage = $discountPercentage;
        $this->discountCoupon = $discountCoupon;
        $this->id = $id;
    }

    public function isExpired(): bool
    {
        return $this->discountExpirationDate->isExpired();
    }

    public function applyOnlyToTheThirdProduct(): bool
    {
        return $this->discountType->applyOnlyToTheThirdProduct();
    }

    public function applyToAllProducts(): bool
    {
        return $this->discountType->applyToAllProducts();
    }

    public function getDiscountPercentage(): DiscountPercentage
    {
        return $this->discountPercentage;
    }
}
