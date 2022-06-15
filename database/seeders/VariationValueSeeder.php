<?php

namespace Database\Seeders;

use App\Models\VariationValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VariationValue::create([
            'value' => 'red',
            'label' => 'red',
            'variation_option_id' => 1,
        ]);
        VariationValue::create([
            'value' => 'green',
            'label' => 'green',
            'variation_option_id' => 1,
        ]);
        VariationValue::create([
            'value' => 'X',
            'label' => 'XL',
            'variation_option_id' => 2,
        ]);

        // product 2
        VariationValue::create([
            'value' => 'green',
            'label' => 'green',
            'variation_option_id' => 3,
        ]);
    }
}
