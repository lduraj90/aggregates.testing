<?php

namespace Devkick\Calculator;

use Devkick\Calculator\ValueObject\Currency;
use Devkick\Calculator\ValueObject\ExchangeRate;

interface CurrencyExchangeRateRepositoryInterface
{
    public function getExchangeRate(Currency $fromCurrency, Currency $toCurrency): ExchangeRate;
}
