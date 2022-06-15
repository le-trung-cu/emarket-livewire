<?php

namespace Database\Seeders;

use App\Models\ProductVariation;
use Illuminate\Database\Seeder;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductVariation::create([
            'sku_id' => 1,
            'variation_value_id' => 1,
        ]);
        ProductVariation::create([
            'sku_id' => 1,
            'variation_value_id' => 3,
        ]);
    }
}
