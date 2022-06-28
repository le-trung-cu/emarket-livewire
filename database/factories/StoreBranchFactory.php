<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreBranch>
 */
class StoreBranchFactory extends Factory
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
            'phone' => $this->faker->randomElement(['077 436 2611', '077 436 2612', '077 436 2613']),
            'address' => $this->faker->address,
            'district_id' => 1528,
            'ward_code' => '40307',
        ];
    }
}
