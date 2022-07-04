<?php

namespace App\Http\Livewire\Site;

use App\Models\Category;
use Livewire\Component;

class ProductByCategory extends Component
{
    public Category $category;
    
    public function render()
    {
        return view('livewire.site.product-by-category')->layout('layouts.site');
    }
}
