<?php

namespace Database\Factories;

use App\Enums\AttendanceType;
use App\Enums\MemberDiscountType;
use App\Enums\MemberType;
use App\Enums\PaymentType;
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
            'attendance_type_id' => fake()->randomElement(AttendanceType::cases())->value,
            'member_discount_type_id' => fake()->optional(0.3)->randomElement(MemberDiscountType::cases())?->value,
            'member_type_id' => fake()->randomElement(MemberType::cases())->value,
            'payment_type_id' => fake()->randomElement(PaymentType::cases())->value,
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
