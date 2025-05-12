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
        $australianStates = config('app.states');

        return [
            'name' => fake('en_AU')->company,
            'street' => fake('en_AU')->streetName,
            'suburb' => fake('en_AU')->city,
            'state' => fake('en_AU')->randomElement($australianStates),
            'pincode' => fake('en_AU')->postcode,
            'phone' => str(fake('en_AU')->phoneNumber)->remove(['+', '(', ')', ' ', '.', '-']),
            'created_by' => 1,
        ];
    }
}
