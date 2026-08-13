<?php

namespace App\Enums;

enum AttendanceType: string
{
    case Participant = 'participant';
    case Speaker = 'speaker';
    case Moderator = 'moderator';
    case Organizer = 'organizer';
    case PrcRepresentative = 'prc_representative';

    public function label(): string
    {
        return match ($this) {
            self::Participant => 'Participant',
            self::Speaker => 'Speaker',
            self::Moderator => 'Moderator',
            self::Organizer => 'Organizer',
            self::PrcRepresentative => 'PRC Representative',
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
