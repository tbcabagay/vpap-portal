<?php

namespace App\Services;

use App\Models\Municipality;

class MunicipalityService extends BaseService
{
    protected function model(): string
    {
        return Municipality::class;
    }
}
