<?php

namespace App\Http\Livewire\Site;

use App\ValueObjects\Cart;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
use Livewire\Component;

class CartDetail extends Component
{
    public function render()
    {
        return view('livewire.site.cart-detail', [
            'cart' => new Cart(),
        ])->layout('layouts.site');
    }

    public function updateCart($rowId, int $num)
    {
        FacadesCart::instance('cart')->update($rowId, $num);
        $this->emitTo('site.cart-icon', 'cartChanged');
    }
}
