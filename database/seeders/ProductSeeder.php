<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->create([
            'store_branch_id' => 5,
        ]);

        Product::factory()->create([
            'store_branch_id' => 7,
        ]);

        Product::factory(20)->create();
    }
}
