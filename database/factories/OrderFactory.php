<?php

namespace Database\Factories;

use App\Enums\PaymentType;
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
            'amount' =>  $this->faker->randomElement([50_000, 60_000, 150_000]),
            'shipping_fee' => $this->faker->randomElement([15_000, 20_000, 40_000, 98_000]),
            'payment_type' => PaymentType::CASH,
            'discount' => 0,
            'service_type_id_ghn' => 1,
            'recipient_name' => $this->faker->name,
            'recipient_phone' => $this->faker->randomElement(['077 436 2625', '077 436 2626', '077 436 2627']),
            'shipping_address' => $this->faker->address(),
            'ward_code' => '340411',
            'district_id' => 1736,
            // 'print_token_ghn',
            'status' => 'pending', //$this->faker->randomElement(['pending', 'registered', 'packing', 'sent', 'complated', 'canceled']),
        ];
    }
}
