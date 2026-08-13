<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\Member;
use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::all();
        $events = Event::all();
        $sponsors = Sponsor::all();

        if ($members->isEmpty()) {
            $members = Member::factory()->count(50)->create();
        }

        if ($events->isEmpty()) {
            $events = Event::factory()->count(50)->create();
        }

        if ($sponsors->isEmpty()) {
            $sponsors = Sponsor::factory()->count(10)->create();
        }

        Attendance::factory()
            ->count(3000)
            ->recycle($members)
            ->recycle($events)
            ->recycle($sponsors)
            ->create();
    }
}
