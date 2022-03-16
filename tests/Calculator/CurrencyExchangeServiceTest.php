<?php

namespace Devkick\Tests\Calculator;

use Devkick\Calculator\CurrencyExchangeRateRepositoryInterface;
use Devkick\Calculator\CurrencyExchangeService;
use Devkick\Calculator\ValueObject\Currency;
use Devkick\Calculator\ValueObject\ExchangeRate;
use Devkick\Calculator\ValueObject\Money;
use PHPUnit\Framework\TestCase;

class CurrencyExchangeServiceTest extends TestCase
{
    public function tearDown()
    {
        \Mockery::close();
    }

    public function testExchange()
    {
        // Arrange
        $repositoryMock = \Mockery::mock(CurrencyExchangeRateRepositoryInterface::class);
        $repositoryMock
            ->shouldReceive('getExchangeRate')
            ->withArgs([Currency::class, Currency::class])
            ->andReturn(new ExchangeRate(0.25));

        $currencyExchangeService = new CurrencyExchangeService($repositoryMock);
        $money = new Money(100, new Currency('PLN'));
        $exchangeTo = new Currency('USD');

        // act
        $newValue = $currencyExchangeService->exchange($exchangeTo, $money);

        // assert
        $this->assertInstanceOf(Money::class, $newValue);
        $this->assertEquals(new Money(25.0, $exchangeTo), $newValue);
    }
}
