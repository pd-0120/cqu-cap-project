<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $australianStates = [
            'New South Wales',
            'Victoria',
            'Queensland',
            'Western Australia',
            'South Australia',
            'Tasmania',
            'Australian Capital Territory',
            'Northern Territory'
        ];

        return [
            'name' => fake('en_AU')->company,
            'street' => fake('en_AU')->streetName,
            'suburb' => fake('en_AU')->city,
            'state' => fake('en_AU')->randomElement($australianStates),
            'pincode' => fake('en_AU')->postcode,
            'phone' => fake('en_AU')->phoneNumber,
            'created_by' => 1,
        ];
    }
}
