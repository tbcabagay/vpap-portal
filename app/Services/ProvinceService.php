<?php

namespace App\Services;

use App\Models\Province;

class ProvinceService extends BaseService
{
    protected function model(): string
    {
        return Province::class;
    }
}
