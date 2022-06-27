<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'store_branch_id' => 1,
            // 'buyer_id',
            // 'group_id',
            'amount' => 300_000,
            'shipping_fee' => 40_000,
            'payment_type' => 1,
            'discount' => 0,
            'service_type_id_ghn' => 1,
            'recipient_name' => $this->faker->name,
            'recipient_phone' => $this->faker->phoneNumber,
            'shipping_address' => $this->faker->address(),
            'ward_code' => '12345',
            'district_id' => 1234,
            // 'print_token_ghn',
            'status' => $this->faker->randomElement(['pending', 'registered', 'packing', 'sent', 'complated', 'canceled']),
        ];
    }
}
