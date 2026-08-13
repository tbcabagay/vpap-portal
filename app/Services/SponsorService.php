<?php

namespace App\Services;

use App\Models\Sponsor;

class SponsorService extends BaseService
{
    protected function model(): string
    {
        return Sponsor::class;
    }
}
