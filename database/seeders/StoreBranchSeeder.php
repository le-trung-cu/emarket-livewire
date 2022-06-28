<?php

namespace Database\Seeders;

use App\Models\StoreBranch;
use Illuminate\Database\Seeder;

class StoreBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StoreBranch::factory(5)->create();
        StoreBranch::factory(10)->create([
            'district_id' => 1456,
            'ward_code' => '21511',
        ]);
    }
}
