<?php

namespace Database\Seeders;

use App\Models\Institution;
use App\Models\Member;
use App\Models\SpeciesOfSpecialization;
use App\Models\TypeOfPractice;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $institutions = Institution::all();

        if ($users->isEmpty()) {
            $users = User::factory()->count(5000)->create();
        }

        if ($institutions->isEmpty()) {
            $institutions = Institution::factory()->count(50)->create();
        }

        $members = Member::factory()
            ->count(5000)
            ->recycle($users)
            ->recycle($institutions)
            ->create();

        $species = SpeciesOfSpecialization::all();
        $practices = TypeOfPractice::all();

        if ($species->isEmpty()) {
            $species = SpeciesOfSpecialization::factory()->count(10)->create();
        }

        if ($practices->isEmpty()) {
            $practices = TypeOfPractice::factory()->count(10)->create();
        }

        $members->each(function (Member $member) use ($species, $practices): void {
            $member->speciesOfSpecializations()->attach($species->random(rand(1, 2))->pluck('id')->all());
            $member->typeOfPractices()->attach($practices->random(rand(1, 2))->pluck('id')->all());
        });
    }
}
