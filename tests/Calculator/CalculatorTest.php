<?php

namespace Devkick\Tests\Calculator;

use Devkick\Calculator\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{

    public function testDivideTwoIntegers()
    {
        // Arrange
        $calculator = new Calculator();

        // Act
        $result = $calculator->divide(6, 3);

        // Assert
        $this->assertEquals(2, $result);
    }

    public function testDivideByZero()
    {
        // Assert
        $this->expectException(\DivisionByZeroError::class);

        // Arrange
        $calculator = new Calculator();

        // Act
        $calculator->divide(6, 0);
    }

    public function testAddTwoIntegers()
    {
        // Arrange
        $calculator = new Calculator();

        // Act
        $result = $calculator->add(7, 3);

        // Assert
        $this->assertEquals(10, $result);
    }
}
