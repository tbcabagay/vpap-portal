<?php

namespace App\Services;

use App\Models\SpeciesOfSpecialization;

class SpeciesOfSpecializationService extends BaseService
{
    protected function model(): string
    {
        return SpeciesOfSpecialization::class;
    }
}
