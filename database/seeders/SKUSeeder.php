<?php

namespace Database\Seeders;

use App\Models\SKU;
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
        SKU::factory(2)->create(['product_id' => 1]);
        SKU::factory()->create(['product_id' => 2]);
    }
}
