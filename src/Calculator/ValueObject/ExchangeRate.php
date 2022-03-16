<?php

namespace Devkick\Calculator\ValueObject;

class ExchangeRate
{
    private float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }
}
