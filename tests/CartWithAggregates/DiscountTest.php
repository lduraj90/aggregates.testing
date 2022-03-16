<?php

namespace Devkick\Tests\CartWithAggregates;

use Devkick\Cart\Domain\Event\DiscountApplyFailedEvent;
use Devkick\CartWithAggregates\Domain\Discount\Discount;
use Devkick\CartWithAggregates\Domain\Discount\Event\DiscountCouponUsedEvent;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountExpirationDate;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountId;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountPercentage;
use Devkick\CartWithAggregates\Domain\Discount\ValueObject\DiscountType;
use PHPUnit\Framework\TestCase;

class DiscountTest extends TestCase
{
    public function testDiscountExpired(): void
    {
        // Arrange
        $discount = new Discount(
            new DiscountType(DiscountType::TO_ALL_PRODUCTS),
            new DiscountPercentage(25.0),
            new DiscountExpirationDate(new \DateTimeImmutable("2020-02-01")),
            new DiscountId("88d881be-2e54-4c24-b0c4-bb226befd7a5")
        );

        // Act
        $discountEvent = $discount->useDiscount();

        // Assert
        $this->assertInstanceOf(DiscountApplyFailedEvent::class, $discountEvent);
    }

    public function testDiscountUsedSuccessfully(): void
    {
        // Arrange
        $discount = new Discount(
            new DiscountType(DiscountType::TO_ALL_PRODUCTS),
            new DiscountPercentage(25.0),
            new DiscountExpirationDate(new \DateTimeImmutable("now + 2 days")),
            new DiscountId("88d881be-2e54-4c24-b0c4-bb226befd7a5")
        );

        // Act
        $discountEvent = $discount->useDiscount();

        // Assert
        $this->assertInstanceOf(DiscountCouponUsedEvent::class, $discountEvent);
    }
}
