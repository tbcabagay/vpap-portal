<?php

namespace App\Http\Resources;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Member */
class MemberResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'institution' => InstitutionResource::make($this->whenLoaded('institution')),
            'species_of_specializations' => SpeciesOfSpecializationResource::collection($this->whenLoaded('speciesOfSpecializations')),
            'type_of_practices' => TypeOfPracticeResource::collection($this->whenLoaded('typeOfPractices')),
        ];
    }
}
