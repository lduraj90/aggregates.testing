<?php

namespace Devkick\CartWithAggregates\Domain\Cart\Event;

use Devkick\CartWithAggregates\Domain\Commons\Money;

class CartNetPriceUpdated implements CartEventInterface
{
    private Money $cartNetPrice;

    public function __construct(Money $cartNetPrice)
    {
        $this->cartNetPrice = $cartNetPrice;
    }

    public function getCartNetPrice(): Money
    {
        return $this->cartNetPrice;
    }
}
