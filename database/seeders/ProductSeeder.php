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

        // $product1 = Product::find(1);
        // $product1 = new Product();
        // $product1->addMediaFromUrl('https://salt.tikicdn.com/cache/400x400/ts/product/da/16/ae/603e0e41bfd0428e3bf9f0137efd2d08.jpg')->toMediaCollection('product-thumbnail');
    }
}
