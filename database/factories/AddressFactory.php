<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Country;
use App\Models\Member;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
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
            'type' => fake()->randomElement(Address::TYPES),
            'address' => fake()->optional(0.8)->streetAddress(),
            'subdivision' => fake()->optional(0.4)->streetName(),
            'barangay' => fake()->optional(0.7)->streetName(),
            'municipality_id' => Municipality::factory(),
            'province_id' => Province::factory(),
            'region_id' => Region::factory(),
            'country_id' => Country::factory(),
            'zip_code' => fake()->postcode(),
            'phone_number' => fake()->optional(0.5)->numerify('(0##) ###-####'),
            'mobile_number' => fake()->optional(0.8)->numerify('09#########'),
        ];
    }
}
