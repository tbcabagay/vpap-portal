<?php

namespace App\Models;

use Database\Factories\TypeOfPracticeFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name'])]
#[WithoutTimestamps]
class TypeOfPractice extends Model
{
    /** @use HasFactory<TypeOfPracticeFactory> */
    use HasFactory;

    /**
     * @return BelongsToMany<Member, $this>
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class);
    }
}
