<?php

namespace Devkick\CartWithAggregates\Domain\Cart;

use Devkick\CartWithAggregates\Domain\Cart\Event\CartEventInterface;
use Devkick\CartWithAggregates\Domain\Cart\Event\CartNetPriceUpdated;
use Devkick\CartWithAggregates\Domain\Cart\Event\CartUpdateFailed;
use Devkick\CartWithAggregates\Domain\Commons\Money;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountPercentage;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountType;

class Cart
{
    private Money $cartNetPrice;

    public function __construct(Money $cartNetPrice)
    {
        $this->cartNetPrice = $cartNetPrice;
        // other data required for cart, ie. list of products
    }

    public function applyDiscount(
        DiscountPercentage $discountPercentage,
        DiscountType $discountType
    ): CartEventInterface {

        if ($discountType->applyOnlyToTheThirdProduct()) {
            $cartNetValue = $this->calculateOnlyThirdProductDiscount($discountPercentage);
            return new CartNetPriceUpdated($cartNetValue);
        }

        if ($discountType->applyToAllProducts()) {
            $cartNetValue = $this->calculateForAllProducts($discountPercentage);
            return new CartNetPriceUpdated($cartNetValue);
        }

        return new CartUpdateFailed();
    }

    private function calculateOnlyThirdProductDiscount(DiscountPercentage $discountPercentage): Money
    {
        $newValue = $this->cartNetPrice;
        // some calculation logic
        $newValue += $newValue * $discountPercentage->getValue() / 100;
        return $newValue;
    }

    private function calculateForAllProducts(DiscountPercentage $discountPercentage): Money
    {
        $newValue = $this->cartNetPrice->getAmount();
        // some calculation logic
        $newValue += $newValue * $discountPercentage->getValue() / 100;

        return new Money($newValue, $this->cartNetPrice->getCurrency());
    }
}
