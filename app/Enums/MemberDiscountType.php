<?php

namespace App\Enums;

enum MemberDiscountType: string
{
    case NoDiscount = 'no_discount';
    case FiftyPercentDiscount = '50_percent_discount';
    case TwentyPercentDiscount = '20_percent_discount';
    case Free = 'free';

    public function label(): string
    {
        return match ($this) {
            self::NoDiscount => 'No Discount',
            self::FiftyPercentDiscount => '50% Discount',
            self::TwentyPercentDiscount => '20% Discount',
            self::Free => 'Free',
        };
    }

    public function rate(): int
    {
        return match ($this) {
            self::NoDiscount => 0,
            self::FiftyPercentDiscount => 50,
            self::TwentyPercentDiscount => 20,
            self::Free => 100,
        };
    }

    /**
     * @return array<string, string|int>
     */
    public function toArray(): array
    {
        return [
            'key' => $this->value,
            'label' => $this->label(),
            'rate' => $this->rate(),
        ];
    }
}
