<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_id' => fake()->randomElement(['conference', 'seminar', 'workshop', 'webinar', 'convention', 'assembly']),
            'invitation_type_id' => fake()->randomElement(['open', 'invitation_only', 'members_only']),
            'title' => fake()->sentence(5),
            'location' => fake()->randomElement([
                fake()->city().', '.fake()->country(),
                fake()->streetAddress(),
            ]),
            'start_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'end_date' => fake()->dateTimeBetween('now', '+6 months'),
            'discount_enabled' => fake()->boolean(30),
            'membership_fee' => fake()->randomFloat(2, 0, 10000),
            'total_cpd_points' => fake()->randomFloat(2, 1, 30),
            'maximum_participants' => fake()->numberBetween(20, 500),
            'evaluation_link' => fake()->randomElement([null, fake()->url()]),
            'invitation_link' => fake()->randomElement([null, fake()->url()]),
        ];
    }
}
