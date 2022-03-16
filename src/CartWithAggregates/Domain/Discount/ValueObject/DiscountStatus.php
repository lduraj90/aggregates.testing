<?php


namespace Devkick\CartWithAggregates\Domain\Discount\ValueObject;


class DiscountStatus
{
    private string $status;

    public function __construct(bool $status)
    {

        $this->status = $status;
    }

    public function isEnabled(): string
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }
}
