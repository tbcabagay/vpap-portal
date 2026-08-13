<?php

namespace Database\Seeders;

use App\Models\TypeOfPractice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOfPracticeSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeOfPractice::factory()->count(10)->create();
    }
}
