<?php
namespace Devkick\Calculator;

interface CalculatorInterface
{
    public function add(float $x, float $y): float;

    public function divide(float $x, float $y): float;
}
