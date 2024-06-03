<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cloth>
 */
class ClothFactory extends Factory
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
            'type' => 'Polo',
            'name' => 'Polo Shirt',
            'size' => $faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'color' => 'White',
            'price_per_piece' => 75000,
            'description' => "Fatto A Mano Men's Collar Polo Shirt, Regular Fit Boys' Top",
            'image_url' => 'https://down-id.img.susercontent.com/file/sg-11134201-22110-m4sp896sd9jv00',
        ];
    }
}
