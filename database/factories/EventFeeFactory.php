<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventFee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EventFee>
 */
class EventFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'member_type_id' => fake()->randomElement(['regular', 'associate', 'student', 'senior', 'lifetime']),
            'amount' => fake()->randomFloat(2, 100, 10000),
        ];
    }
}
