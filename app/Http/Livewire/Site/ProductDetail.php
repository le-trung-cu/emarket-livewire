<?php

namespace App\Http\Livewire\Site;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public function render()
    {
        return view('livewire.site.product-detail', [
            'galaries' => $this->product->getMedia('product-galary'),
        ])->layout('layouts.site');
    }
}
