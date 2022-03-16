<?php

namespace Devkick\CartWithAggregates\Domain\Discount\Event;

use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountId;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountPercentage;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountType;

class DiscountCouponUsedEvent implements DiscountEventInterface
{
    private DiscountType $discountType;
    private DiscountPercentage $discountPercentage;
    private DiscountId $discountId;

    public function __construct(
        DiscountType $discountType,
        DiscountPercentage $discountPercentage,
        DiscountId $discountId
    ) {
        $this->discountType = $discountType;
        $this->discountPercentage = $discountPercentage;
        $this->discountId = $discountId;
    }

    public function getDiscountType(): DiscountType
    {
        return $this->discountType;
    }

    public function getDiscountPercentage(): DiscountPercentage
    {
        return $this->discountPercentage;
    }

    public function getDiscountId(): DiscountId
    {
        return $this->discountId;
    }
}
