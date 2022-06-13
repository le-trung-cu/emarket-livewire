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
        StoreBranch::factory(2)->create();
    }
}
