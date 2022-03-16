<?php

namespace Devkick\Cart\Domain\Repository;

use Devkick\Cart\Domain\Entity\Cart;
use Devkick\Cart\Domain\ValueObject\CartId;

interface CartRepositoryInterface
{
    public function getCart(): Cart;

    public function saveCart(Cart $cart): void;
}
