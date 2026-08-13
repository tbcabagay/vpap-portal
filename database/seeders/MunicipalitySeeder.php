<?php

namespace Database\Seeders;

use App\Models\Municipality;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = Province::all();

        if ($provinces->isEmpty()) {
            $provinces = Province::factory()->count(80)->create();
        }

        Municipality::factory()->count(300)->recycle($provinces)->create();
    }
}
