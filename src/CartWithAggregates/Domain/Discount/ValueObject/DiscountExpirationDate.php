<?php


namespace Devkick\CartWithAggregates\Domain\Discount\ValueObject;


class DiscountExpirationDate
{
    private \DateTimeInterface $dateTime;

    public function __construct(\DateTimeInterface $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function isExpired()
    {
        return $this->dateTime < new \DateTime('now');
    }
}
