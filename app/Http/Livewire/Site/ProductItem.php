<?php

namespace App\Http\Livewire\Site;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use WireUi\Traits\Actions;

class ProductItem extends Component
{
    use Actions;
    public Product $product;

    public function render()
    {
        return view('livewire.site.product-item');
    }

    public function addToCart()
    {
        if ($this->product->skus()->count() > 1) {
            return redirect()->route('site.product.show', $this->product);
        }
        $sku = $this->product->skus()->first();
        Cart::instance('cart')->add([
            'id' => $sku->id,
            'name' => $sku->product->name,
            'qty' => 1,
            'price' => $sku->price_value,
            'weight' => $sku->weight,
        ]);

        $this->notification()->success(
            $title = 'Success!',
            $description = 'You have added ' . $sku->product->name . ' to your shopping cart!',
        );

        $this->emitTo('site.cart-icon', 'cartChanged');
    }
}
