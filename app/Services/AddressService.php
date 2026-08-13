<?php

namespace App\Services;

use App\Models\Address;

class AddressService extends BaseService
{
    protected function model(): string
    {
        return Address::class;
    }
}
