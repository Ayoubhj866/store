<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
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
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'image' => 'https://picsum.photos/500/350?random='.$this->faker->unique()->numberBetween(1, 1000),
        ];
    }
}
