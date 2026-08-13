<?php

namespace App\Services;

use App\Models\MemberServiceYear;

class MemberServiceYearService extends BaseService
{
    protected function model(): string
    {
        return MemberServiceYear::class;
    }
}
