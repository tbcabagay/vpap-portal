<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = Region::all();

        if ($regions->isEmpty()) {
            $regions = Region::factory()->count(18)->create();
        }

        Province::factory()->count(80)->recycle($regions)->create();
    }
}
