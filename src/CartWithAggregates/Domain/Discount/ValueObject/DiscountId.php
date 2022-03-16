<?php


namespace Devkick\CartWithAggregates\Domain\Discount\ValueObject;


class DiscountId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
