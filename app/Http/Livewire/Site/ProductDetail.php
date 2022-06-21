<?php

namespace App\Http\Livewire\Site;

use App\Models\Product;
use App\Models\SKU;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public SKU $sku;

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
    }

    public function addToCart($sku)
    {
       dd($sku);
    }

    public function data()
    {
        $variantionValueIds = $this->product->skus->map(fn ($item) => $item->variationValues->map(fn ($value) => $value->id)->sort());
        $mapVariantionCombinateToSku = (array) $this->product->skus
            ->reduce(function ($result, $item) {
                $key = implode('_', $item->variationValues->map(fn ($value) => $value->id)->sort());
                $result[$key] = ['id' => $item->id, 'price' => $item->price];
            }, []);

        // collect([])->reduce()
        // [
        //     'variation_value_id_combinate' => 'sku',
        // ];

        // [
        //     ['variation_value_id, ...']
        // ];
        // sku->variationValues
        [['variation_value_id_selected']];
    }
}
