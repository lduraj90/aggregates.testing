<?php


namespace Devkick\CartWithAggregates\Domain\Discount\ValueObject;


class DiscountPercentage
{
    private float $value;

    public function __construct(float $value)
    {

        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
