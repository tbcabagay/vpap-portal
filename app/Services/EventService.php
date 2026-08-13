<?php

namespace App\Services;

use App\Models\Event;

class EventService extends BaseService
{
    protected function model(): string
    {
        return Event::class;
    }
}
