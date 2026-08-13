<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Country;
use App\Models\Member;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::all();
        $countries = Country::all();
        $regions = Region::all();
        $provinces = Province::all();
        $municipalities = Municipality::all();

        if ($members->isEmpty()) {
            $members = Member::factory()->count(50)->create();
        }

        if ($countries->isEmpty()) {
            $countries = Country::factory()->count(5)->create();
        }

        if ($regions->isEmpty()) {
            $regions = Region::factory()->count(5)->create();
        }

        if ($provinces->isEmpty()) {
            $provinces = Province::factory()->count(20)->recycle($regions)->create();
        }

        if ($municipalities->isEmpty()) {
            $municipalities = Municipality::factory()->count(50)->recycle($provinces)->create();
        }

        Address::factory()
            ->count(5000)
            ->recycle($members)
            ->recycle($countries)
            ->recycle($regions)
            ->recycle($provinces)
            ->recycle($municipalities)
            ->create();
    }
}
