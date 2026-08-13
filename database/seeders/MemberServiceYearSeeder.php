<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\MemberServiceYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberServiceYearSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::all();

        if ($members->isEmpty()) {
            $members = Member::factory()->count(50)->create();
        }

        $members
            ->shuffle()
            ->take(min(1000, $members->count()))
            ->each(fn (Member $member) => MemberServiceYear::factory()->create([
                'member_id' => $member->id,
            ]));
    }
}
