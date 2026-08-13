<?php

namespace App\Models;

use Database\Factories\AttendanceFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['member_id', 'event_id', 'sponsor_id', 'attendance_type_id', 'member_discount_type_id', 'member_type_id', 'payment_type_id', 'membership_fee', 'event_fee', 'discount_fee', 'discount_percentage', 'total_fees', 'cpd_points', 'payment_status', 'attendance_status'])]
class Attendance extends Model
{
    /** @use HasFactory<AttendanceFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'membership_fee' => 'decimal:2',
            'event_fee' => 'decimal:2',
            'discount_fee' => 'decimal:2',
            'discount_percentage' => 'integer',
            'total_fees' => 'decimal:2',
            'cpd_points' => 'decimal:2',
        ];
    }

    /**
     * @return BelongsTo<Member, $this>
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * @return BelongsTo<Event, $this>
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * @return BelongsTo<Sponsor, $this>
     */
    public function sponsor(): BelongsTo
    {
        return $this->belongsTo(Sponsor::class);
    }
}
