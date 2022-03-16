<?php

namespace Devkick\Cart\Domain\ValueObject;

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
