<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesLv1 = Category::factory(5)->make()->toArray();
        DB::table('categories')->upsert($categoriesLv1, ['name', 'slug']);

        $categoriesLv1 = Category::all();

        foreach ($categoriesLv1 as $category) {
            $categoriesLv2 = Category::factory(3)->make(['parent_id' => $category->id])->toArray();
            DB::table('categories')->upsert($categoriesLv2, ['name', 'slug']);
        }
    }
}
