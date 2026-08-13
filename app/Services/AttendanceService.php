<?php

namespace App\Services;

use App\Models\Attendance;

class AttendanceService extends BaseService
{
    protected function model(): string
    {
        return Attendance::class;
    }
}
