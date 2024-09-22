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
            'name' => fake()->name(),
            'description' => fake()->paragraph(8),
            'price' => fake()->randomFloat(2, 10, 1000),
            'brand' => fake()->randomElement(['Apple', 'LG', 'Samsung']),
            'category' => fake()->randomElement(['Phone', 'Computer', 'Sound']),
            'image' => 'https://picsum.photos/500/350?random='.$this->faker->unique()->numberBetween(1, 1000),
        ];
    }
}
