<?php

namespace App\Enums;

enum EventType: string
{
    case MembershipMeeting = 'membership_meeting';
    case SeminarWorkshop = 'seminar_workshop';
    case RegionalConference = 'regional_conference';
    case AnnualConference = 'annual_conference';
    case OtherConference = 'other_conference';

    public function label(): string
    {
        return match ($this) {
            self::MembershipMeeting => 'Membership Meeting',
            self::SeminarWorkshop => 'Seminar/Workshop',
            self::RegionalConference => 'Regional Conference',
            self::AnnualConference => 'Annual Conference',
            self::OtherConference => 'Other Conference',
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
