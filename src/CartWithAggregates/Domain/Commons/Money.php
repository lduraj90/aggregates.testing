<?php

namespace Devkick\CartWithAggregates\Domain\Commons;

class Money
{
    private float $amount;
    private Currency $currency;

    public function __construct(float $amount, Currency $currency)
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function format(): string
    {
        return sprintf('%s %s', round($this->amount, 2), $this->currency->getCurrencyCode());
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}
