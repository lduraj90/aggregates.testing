<?php


namespace Devkick\CartWithAggregates\Domain\Discount\ValueObject;


class DiscountType
{
    public const ONLY_TO_THIRD_PRODUCT = 'only-third';
    public const TO_ALL_PRODUCTS = 'all-products';
    private string $type;

    public function __construct(string $type)
    {
        if (!in_array($type, $this->getAvailableTypes())) {
            throw new \Exception('Wrong Discount Type');
        }

        $this->type = $type;
    }

    public function applyOnlyToTheThirdProduct(): bool
    {
        return $this->type === self::ONLY_TO_THIRD_PRODUCT;
    }

    public function applyToAllProducts(): bool
    {
        return $this->type === self::TO_ALL_PRODUCTS;
    }

    public function getAvailableTypes()
    {
        return [
            self::ONLY_TO_THIRD_PRODUCT,
            self::TO_ALL_PRODUCTS,
        ];
    }
}
