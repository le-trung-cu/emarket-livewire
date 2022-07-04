<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->jsonSeeder();
    }

    private function jsonSeeder()
    {
        $files = File::files('database/data/products/dien-thoai-may-tinh-bang');
        foreach ($files as $file) {
            $categorySlug = pathinfo($file->getPathname())['filename'];
            $categoryEntity = Category::where('slug', $categorySlug)->firstOrFail();

            $products = json_decode(File::get($file->getPathname()));
            
            foreach ($products as $product) {
                Product::factory()->create([
                    'name' => $product->name,
                    'thumbnail' => $product->thumbnail,
                    'regular_price' =>  str_replace([' ', '₫', '.'], '', $product->price),
                    'category_id' => $categoryEntity->id,
                    'store_branch_id' => 5,
                    'slug' => SlugService::createSlug(Product::class, 'slug', $product->name)
                ]);
            }
        }
    }

    private function factorySeeder()
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
