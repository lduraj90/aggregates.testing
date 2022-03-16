<?php

namespace Devkick\Cart\Domain\Entity;

use Devkick\Cart\Domain\ValueObject\DiscountPercentage;
use Devkick\Cart\Domain\ValueObject\Money;

class Cart
{
    private Money $cartNetPrice;

    public function __construct(Money $cartNetPrice)
    {
        $this->cartNetPrice = $cartNetPrice;
        // other data required for cart, ie. list of products
    }

    public function calculateOnlyThirdProductDiscount(DiscountPercentage $discountPercentage): void
    {
        $newValue = $this->cartNetPrice;
        // some calculation logic
        $newValue += $newValue * $discountPercentage->getValue() / 100;
        $this->cartNetPrice = $newValue;
    }

    public function calculateForAllProducts(DiscountPercentage $discountPercentage): void
    {
        $newValue = $this->cartNetPrice->getAmount();
        // some calculation logic
        $newValue += $newValue * $discountPercentage->getValue() / 100;

        $this->cartNetPrice = new Money($newValue, $this->cartNetPrice->getCurrency());
    }
}
