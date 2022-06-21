<?php

namespace App\Http\Livewire\Site;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartIcon extends Component
{
    protected $listeners = ['cartChanged' => '$refresh'];
    
    public function render()
    {
        return view('livewire.site.cart-icon', [
            'count' => Cart::instance('cart')->count(),
        ]);
    }
}
