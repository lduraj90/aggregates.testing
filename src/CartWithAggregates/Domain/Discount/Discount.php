<?php

namespace Devkick\CartWithAggregates\Domain\Discount;

use Devkick\Cart\Domain\Event\DiscountApplyFailedEvent;
use Devkick\CartWithAggregates\Domain\Discount\Event\DiscountEventInterface;
use Devkick\CartWithAggregates\Domain\Discount\Event\DiscountCouponUsedEvent;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountExpirationDate;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountId;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountPercentage;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountType;

class Discount
{
    private DiscountType $discountType;
    private DiscountPercentage $discountPercentage;
    private DiscountId $id;
    private DiscountExpirationDate $discountExpirationDate;

    public function __construct(
        DiscountType $discountType,
        DiscountPercentage $discountPercentage,
        DiscountExpirationDate $discountExpirationDate,
        DiscountId $id
    ) {
        $this->discountType = $discountType;
        $this->discountPercentage = $discountPercentage;
        $this->id = $id;
        $this->discountExpirationDate = $discountExpirationDate;
    }

    public function useDiscount(): DiscountEventInterface
    {
        if ($this->discountExpirationDate->isExpired()) {
            return new DiscountApplyFailedEvent();
        }
        // some logic to check if the discount is still valid after usage
        return new DiscountCouponUsedEvent($this->discountType, $this->discountPercentage, $this->id);
    }
}
