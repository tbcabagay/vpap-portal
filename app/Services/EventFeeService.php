<?php

namespace App\Services;

use App\Models\EventFee;

class EventFeeService extends BaseService
{
    protected function model(): string
    {
        return EventFee::class;
    }
}
