<?php

namespace App\Models;

use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['type_id', 'invitation_type_id', 'title', 'location', 'start_date', 'end_date', 'discount_enabled', 'membership_fee', 'total_cpd_points', 'maximum_participants', 'evaluation_link', 'invitation_link'])]
class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'discount_enabled' => 'boolean',
            'membership_fee' => 'decimal:2',
            'total_cpd_points' => 'decimal:2',
            'maximum_participants' => 'integer',
        ];
    }

    /**
     * @return HasMany<EventFee, $this>
     */
    public function eventFees(): HasMany
    {
        return $this->hasMany(EventFee::class);
    }

    /**
     * @return HasMany<Attendance, $this>
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
