<?php

namespace App\Enums;

enum MemberType: string
{
    case Lifetime = 'lifetime';
    case Regular = 'regular';
    case NonMember = 'non_member';

    public function label(): string
    {
        return match ($this) {
            self::Lifetime => 'Lifetime',
            self::Regular => 'Regular',
            self::NonMember => 'Non-Member',
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
