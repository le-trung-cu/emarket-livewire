<?php

namespace App\Http\Livewire\Site;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductByCategory extends Component
{
    use WithPagination;
    
    public Category $category;

    public function render()
    {
        if ($this->category->isLeaf()) {
            $products = Product::query()->where('category_id', $this->category->id)->paginate();
        } else {
            $categories = Category::query()->whereDescendantOf($this->category)->whereIsLeaf()->get()->pluck('id');
            $products = Product::query()->whereIn('category_id', $categories)->inRandomOrder()->paginate();
        }
        return view('livewire.site.product-by-category', [
            'products' => $products,
        ])->layout('layouts.site');
    }
}
