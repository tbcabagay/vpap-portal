<?php

namespace App\Services;

use App\Models\Region;

class RegionService extends BaseService
{
    protected function model(): string
    {
        return Region::class;
    }
}
