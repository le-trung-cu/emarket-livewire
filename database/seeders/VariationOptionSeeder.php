<?php

namespace Database\Seeders;

use App\Models\VariationOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VariationOption::create([
            'name' => 'color',
            'visual' => 'text',
            'product_id' => 1,
        ]);

        VariationOption::create([
            'name' => 'size',
            'visual' => 'text',
            'product_id' => 1,
        ]);

        VariationOption::create([
            'name' => 'color',
            'visual' => 'text',
            'product_id' => 2,
        ]);
    }
}
