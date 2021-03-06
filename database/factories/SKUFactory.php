<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SKU>
 */
class SKUFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'activity' => true,
            'weight' => 120,
            'price' =>  $this->faker->randomElement([150_000.00, 120_000.00, 60_000.00, 2_000_000.00, 1_000_000.00, 1_200_000.00, 23_000_000.00]),
            'stock' => 12,
            'barcode' => \Illuminate\Support\Str::random(8),
        ];
    }
}
