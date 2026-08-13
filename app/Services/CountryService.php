<?php

namespace App\Services;

use App\Models\Country;

class CountryService extends BaseService
{
    protected function model(): string
    {
        return Country::class;
    }
}
