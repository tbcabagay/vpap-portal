<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventFee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventFeeSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();

        if ($events->isEmpty()) {
            $events = Event::factory()->count(100)->create();
        }

        EventFee::factory()->count(500)->recycle($events)->create();
    }
}
