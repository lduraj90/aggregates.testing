<?php

namespace Devkick\Calculator;

use Devkick\Calculator\ValueObject\Currency;
use Devkick\Calculator\ValueObject\Money;

final class CurrencyExchangeService
{
    private $currencyRepository;

    public function __construct(CurrencyExchangeRateRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function exchange(Currency $toCurrency, Money $money)
    {
        $exchangeRate = $this->currencyRepository->getExchangeRate($money->getCurrency(), $toCurrency);
        $newValue = $money->getAmount() * $exchangeRate->getValue();

        return new Money($newValue, $toCurrency);
    }
}
