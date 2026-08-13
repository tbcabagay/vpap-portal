<?php

namespace App\Services;

use App\Models\TypeOfPractice;

class TypeOfPracticeService extends BaseService
{
    protected function model(): string
    {
        return TypeOfPractice::class;
    }
}
