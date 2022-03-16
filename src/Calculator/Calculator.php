<?php
namespace Devkick\Calculator;

final class Calculator implements CalculatorInterface
{
    public function add(float $x, float $y): float
    {
        return $x + $y;
    }

    public function divide(float $x, float $y): float
    {
        if ($y == 0) {
            throw new \DivisionByZeroError();
        }

        return $x / $y;
    }
}
