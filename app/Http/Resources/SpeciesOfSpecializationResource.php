<?php

namespace App\Http\Resources;

use App\Models\SpeciesOfSpecialization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin SpeciesOfSpecialization */
class SpeciesOfSpecializationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
