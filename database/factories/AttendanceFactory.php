<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\Member;
use App\Models\Sponsor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_id' => Member::factory(),
            'event_id' => Event::factory(),
            'sponsor_id' => fake()->boolean(50) ? Sponsor::factory() : null,
            'attendance_type_id' => fake()->randomElement(['full', 'partial', 'online', 'guest']),
            'member_discount_type_id' => fake()->optional(0.3)->randomElement(['senior', 'student', 'early_bird', 'lifetime']),
            'member_type_id' => fake()->randomElement(['regular', 'associate', 'student', 'senior', 'lifetime']),
            'payment_type_id' => fake()->randomElement(['cash', 'bank_transfer', 'gcash', 'card', 'sponsorship']),
            'membership_fee' => fake()->randomFloat(2, 0, 10000),
            'event_fee' => fake()->randomFloat(2, 0, 10000),
            'discount_fee' => fake()->randomFloat(2, 0, 5000),
            'discount_percentage' => fake()->numberBetween(0, 50),
            'total_fees' => fake()->randomFloat(2, 0, 15000),
            'cpd_points' => fake()->randomFloat(2, 1, 15),
            'payment_status' => fake()->randomElement(['paid', 'unpaid', 'pending', 'refunded']),
            'attendance_status' => fake()->randomElement(['present', 'absent', 'excused', 'late']),
        ];
    }
}
