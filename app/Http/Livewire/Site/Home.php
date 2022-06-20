<?php

namespace App\Http\Livewire\Site;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.site.home', [
            'categories' => Category::where('parent_id', null)->get(),
            'newProducts' => Product::query()->latest()->take(8)->get(),
        ])->layout('layouts.site');
    }
}
