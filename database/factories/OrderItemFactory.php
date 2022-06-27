<?php

namespace Database\Factories;

use App\Models\SKU;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomElement([20_000, 40_000, 50_000, 100_000, 200_000]),
            'qty' => $this->faker->randomElement([1,2,3]),
            'product_name' => $this->faker->name,
            'variation_string' => '',
            'sku_id' => SKU::inRandomOrder()->first()->id,
            // 'order_id',
            // 'sku_id',
        ];
    }
}
