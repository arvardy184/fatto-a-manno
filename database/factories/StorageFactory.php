<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Storage>
 */
class StorageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Set the Faker locale to Indonesian (id)
        $faker = Faker::create('id_ID');

        return [
            'name' => $faker->lastName,
            'quantity_limit' => $faker->numberBetween(10000, 20000), // Example range for quantity limit
            'address' => $faker->address,
        ];
    }
}
