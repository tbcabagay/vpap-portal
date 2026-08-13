<?php

namespace Database\Seeders;

use App\Models\SpeciesOfSpecialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpeciesOfSpecializationSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SpeciesOfSpecialization::factory()->count(15)->create();
    }
}
