<?php

namespace Devkick\CartWithAggregates\Domain\Cart\Repository;

use Devkick\CartWithAggregates\Domain\Cart\Cart;
use Devkick\CartWithAggregates\Domain\Cart\Event\CartEventInterface;

interface CartRepositoryInterface
{
    public function getCart(): Cart;

    public function handleCartEvent(CartEventInterface $cartEvent): void;
}
