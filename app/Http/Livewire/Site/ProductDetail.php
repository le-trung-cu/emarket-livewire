<?php

namespace App\Http\Livewire\Site;

use App\Models\Product;
use App\Models\SKU;
use Brick\Money\Money;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Js;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public SKU $sku;
    public $skus;
    public $options;
    public $galaries;

    public function render()
    {
        return view('livewire.site.product-detail')->layout('layouts.site');
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->sku = $product->skus()->first();
        $this->galaries = $this->product->getMedia('product-galary');
        $this->similarProducts = $this->product->similarProducts(4);

        $this->options = $product->variationOptions()->with('values')->get()
            ->map(
                fn ($option) => [
                    'id' => $option->id,
                    'name' => $option->name,
                    'visual' => $option->visual,
                    'values' => $option->values->map(fn ($value) => ['id' => $value->id, 'value' => $value->value])
                ]
            );

        $this->skus = (object) $product->skus()->with('variationValues')->get()->mapWithKeys(function ($item, $key) {
            return [
                $item['id'] => [
                    'barcode' => $item->barcode,
                    'id' => $item->id,
                    'price' => Blade::render('{{$price}}', ['price' => $item->price]),
                    'variantionValueIds' => $item->variationValues->map(fn ($value) => $value->id),
                ]
            ];
        });
    }

    public function addToCart(SKU $sku)
    {
        Cart::instance('cart')->add([
            'id' => $sku->id,
            'name' => $sku->product->name,
            'qty' => 1,
            'price' => $sku->price_value,
            'weight' => $sku->weight,
        ]);

        $this->emitTo('site.cart-icon', 'cartChanged');
    }
}
