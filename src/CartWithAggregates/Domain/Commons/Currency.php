<?php

namespace Devkick\CartWithAggregates\Domain\Commons;

class Currency
{
    private string $currencyCode;

    public function __construct(string $currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }
}
