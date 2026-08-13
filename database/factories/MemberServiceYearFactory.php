<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\MemberServiceYear;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MemberServiceYear>
 */
class MemberServiceYearFactory extends Factory
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
            'year' => (string) fake()->numberBetween(1970, 2026),
            'officer_position' => fake()->optional(0.6)->randomElement([
                'President',
                'Vice President',
                'Secretary',
                'Treasurer',
                'Auditor',
                'Public Information Officer',
                'Board Member',
            ]),
        ];
    }
}
