<?php

namespace App\Enums;

enum Role: string
{
    case Member = 'member';
    case Admin = 'admin';

    public function label(): string
    {
        return match ($this) {
            self::Member => 'Member',
            self::Admin => 'Admin',
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
