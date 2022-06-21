<?php

namespace App\Http\Livewire\Site;

use App\Models\Product;
use App\Models\SKU;
use Brick\Money\Money;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public SKU $sku;
    public $skus;
    public $options;

    public function render()
    {
        return view('livewire.site.product-detail', [
            'galaries' => $this->product->getMedia('product-galary'),
        ])->layout('layouts.site');
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->sku = $product->skus()->first();

        $this->options = $product->variationOptions()->with('values')->get()
            ->map(
                fn ($option) => [
                    'id' => $option->id,
                    'name' => $option->name,
                    'visual' => $option->visual,
                    'values' => $option->values->map(fn ($value) => ['id' => $value->id, 'value' => $value->value])
                ]
            );
            // (object) Product::find(1)->skus()->with('variationValues')->get()->mapWithKeys(function($item, $key) {return [$item['id'] => ['barcode' => $item->barcode, 'id' => $item->id, 'price' => $item->price_vnd, 'variantionValueIds' => $item->variationValues->map(fn($value) => $value->id)]];});
        
            $this->skus = (object) $product->skus()->with('variationValues')->get()->mapWithKeys(function($item, $key) {return [$item['id'] => ['barcode' => $item->barcode, 'id' => $item->id, 'price' => $item->price_vnd, 'variantionValueIds' => $item->variationValues->map(fn($value) => $value->id)]];});
        }

    public function addToCart($sku)
    {
        dd($sku);
    }
}
