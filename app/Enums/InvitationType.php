<?php

namespace App\Enums;

enum InvitationType: string
{
    case Open = 'open';
    case MembersOnly = 'members_only';
    case InviteOnly = 'invite_only';

    public function label(): string
    {
        return match ($this) {
            self::Open => 'Open',
            self::MembersOnly => 'Members Only',
            self::InviteOnly => 'Invite Only',
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
