<?php

namespace App\Enums;

enum PaymentType: string
{
    case Personal = 'personal';
    case Sponsor = 'sponsor';
    case Free = 'free';

    public function label(): string
    {
        return match ($this) {
            self::Personal => 'Personal',
            self::Sponsor => 'Sponsor',
            self::Free => 'Free',
        };
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'key' => $this->value,
            'label' => $this->label(),
        ];
    }
}
