<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(AdminSeeder::class);
        $this->call(StoreBranchSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SKUSeeder::class);
        $this->callWith(OrderSeeder::class, ['buyer' => User::find(1)]);
        $this->callWith(OrderItemSeeder::class, ['orders' => Order::all()]);
        // $this->call(VariationOptionSeeder::class);
        // $this->call(VariationValueSeeder::class);
        // $this->call(ProductVariationSeeder::class);
    }
}
