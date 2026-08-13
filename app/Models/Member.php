<?php

namespace App\Models;

use Database\Factories\MemberFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id', 'first_name', 'middle_name', 'last_name', 'suffix', 'certificate_complete_name', 'nickname', 'birth_date', 'institution_id', 'graduated_at', 'is_employed', 'company_name', 'position', 'member_type_id', 'member_discount_type_id', 'joined_at', 'license_number', 'license_expiry_date', 'was_president'])]
#[WithoutTimestamps]
class Member extends Model
{
    /** @use HasFactory<MemberFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'is_employed' => 'boolean',
            'license_expiry_date' => 'date',
            'was_president' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Institution, $this>
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    /**
     * @return BelongsToMany<SpeciesOfSpecialization, $this>
     */
    public function speciesOfSpecializations(): BelongsToMany
    {
        return $this->belongsToMany(SpeciesOfSpecialization::class);
    }

    /**
     * @return BelongsToMany<TypeOfPractice, $this>
     */
    public function typeOfPractices(): BelongsToMany
    {
        return $this->belongsToMany(TypeOfPractice::class);
    }

    /**
     * @return HasMany<Address, $this>
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * @return HasMany<Attendance, $this>
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * @return HasMany<MemberServiceYear, $this>
     */
    public function serviceYears(): HasMany
    {
        return $this->hasMany(MemberServiceYear::class);
    }
}
