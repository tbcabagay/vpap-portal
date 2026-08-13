<?php

namespace App\Services;

use App\Models\Institution;

class InstitutionService extends BaseService
{
    protected function model(): string
    {
        return Institution::class;
    }
}
