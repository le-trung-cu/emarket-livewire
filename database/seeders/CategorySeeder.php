<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->jsonFileSeeder();
    }


    private function jsonFileSeeder()
    {
        $categoriesFiles = File::files('database/data/categories');

        foreach($categoriesFiles as $file) {
            $json = File::get($file->getPathname());
            $rootCategory = json_decode($json);

            $stack = [];
            array_unshift($stack, $rootCategory);
            $parentEntity = Category::create([
                'name' => $rootCategory->name,
                'slug' => $rootCategory->slug,
            ]);

            while (count($stack) > 0) {
                $parent = array_shift($stack);
                $parentEntity = Category::where('slug', $parent->slug)->firstOrFail();
                foreach($parent->children as $categoryChild) {
                    $categoryChildEntity = Category::create([
                        'name' => $categoryChild->name,
                        'slug' => $categoryChild->slug,
                        'parent_id' => $parentEntity->id,
                    ]);
                    array_unshift($stack, $categoryChild);
                }
            }
        }
    }

    private function factorySeeder()
    {
        $categoriesLv1 = Category::factory(5)->make()->toArray();
        DB::table('categories')->upsert($categoriesLv1, ['name', 'slug']);

        $categoriesLv1 = Category::all();

        foreach ($categoriesLv1 as $category) {
            $categoriesLv2 = Category::factory(3)->make(['parent_id' => $category->id])->toArray();
            DB::table('categories')->upsert($categoriesLv2, ['name', 'slug']);
        }

        $categoriesLv2 = Category::query()->where('parent_id', '<>', null)->get();
        foreach ($categoriesLv2 as $category) {
            $categoriesLv3 = Category::factory(3)->make(['parent_id' => $category->id])->toArray();
            DB::table('categories')->upsert($categoriesLv3, ['name', 'slug']);
        }
    }
}
