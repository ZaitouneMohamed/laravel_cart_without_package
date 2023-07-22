<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'image' => fake()->imageUrl($width = 640, $height = 480),
            'old_price' => fake()->numberBetween($min = 8000, $max = 9000),
            'new_price' => fake()->numberBetween($min = 7000, $max = 8000),
        ];
    }
}
