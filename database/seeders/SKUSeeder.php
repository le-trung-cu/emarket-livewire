<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SKU;
use App\Models\VariationOption;
use App\Models\VariationValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SKUSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // skus for produc 1,2
        SKU::factory(3)->create(['product_id' => 1]);
        SKU::factory()->create(['product_id' => 2]);
        $variationOptions = collect(['color', 'size', 'gender'])->map(function($name) {
            return VariationOption::create([
                'name' => $name,
                'visual' => 'text',
                'product_id' => 1,
            ]);
        });

        // 1-2-3
        collect(['red', 'green', 'blue'])->map(function($value) {
            return VariationValue::create([
                'value' => $value,
                'label' => $value,
                'variation_option_id' => 1
            ]);
        });

        // 4-5
        collect(['X', 'XL'])->map(function($value) {
            return VariationValue::create([
                'value' => $value,
                'label' => $value,
                'variation_option_id' => 2
            ]);
        });

        // 6-7
        collect(['Famele', 'Manly'])->map(function($value) {
            return VariationValue::create([
                'value' => $value,
                'label' => $value,
                'variation_option_id' => 3
            ]);
        });

        SKU::find(1)->variationValues()->sync([1, 4, 6]);
        SKU::find(2)->variationValues()->sync([1, 4, 7]);
        SKU::find(3)->variationValues()->sync([2, 5, 6]);

        // end skus for product 1,2

        $products = Product::where('id', '>', 2)->get();
        $products->each(fn($product) => SKU::factory()->create([
            'price' => $product->regular_price,
            'product_id' => $product->id,
        ]));
    }
}
