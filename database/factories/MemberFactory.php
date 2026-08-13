<?php

namespace Database\Factories;

use App\Enums\MemberDiscountType;
use App\Enums\MemberType;
use App\Models\Institution;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional(0.5)->lastName(),
            'last_name' => fake()->lastName(),
            'suffix' => fake()->optional(0.1)->randomElement(['Jr.', 'Sr.', 'II', 'III', 'IV']),
            'certificate_complete_name' => fake()->name(),
            'nickname' => fake()->optional(0.6)->firstName(),
            'birth_date' => fake()->dateTimeBetween('-80 years', '-18 years'),
            'institution_id' => Institution::factory(),
            'graduated_at' => (string) fake()->numberBetween(1970, 2026),
            'is_employed' => fake()->boolean(70),
            'company_name' => fake()->optional(0.6)->company(),
            'position' => fake()->optional(0.6)->jobTitle(),
            'member_type_id' => fake()->randomElement(MemberType::cases())->value,
            'member_discount_type_id' => fake()->optional(0.3)->randomElement(MemberDiscountType::cases())?->value,
            'joined_at' => (string) fake()->numberBetween(1970, 2026),
            'license_number' => fake()->randomElement([null, fake()->unique()->numerify('#########')]),
            'license_expiry_date' => fake()->optional(0.8)->dateTimeBetween('now', '+5 years'),
            'was_president' => fake()->boolean(5),
        ];
    }
}
