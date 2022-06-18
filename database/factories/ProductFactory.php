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
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'regular_price' => 150_000.00,
            'status' => $this->faker->randomElement([1, 2, 3]),
            'store_branch_id' => $this->faker->randomElement([1, 2]),
            'category_id' => 1,
        ];
    }
}
