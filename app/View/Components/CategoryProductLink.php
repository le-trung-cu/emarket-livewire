<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\View\Component;

class CategoryProductLink extends Component
{
    public ?Product $product;
    public ?Category $category;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($category = null, $product = null)
    {
        $this->product = null;

        if($product != null){
            $this->product = $product;
            $this->category = $product->category()->with('ancestors')->first();
        }else if($category != null) {
            $this->category = $category;
        }else {
            throw new Exception('product or category is must not null');
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-product-link');
    }
}
