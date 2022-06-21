<?php

namespace App\ValueObjects;

use App\Models\SKU;
use Brick\Money\Money;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;

class Cart {

    public $cartItems;

    public function __construct() {
        $cart = FacadesCart::instance('cart')->content();
        $skuIds = $cart->map(fn ($item) => $item->id);
        $mapSkuIds = SKU::find($skuIds)->mapWithKeys(fn ($item, $key) => [$item['id'] => $item]);
        $this->cartItems = $cart->map(fn($item) => new CartItem($item, $mapSkuIds[$item->id]));
    }

    //  return the result rounded based on the default number format
    public function priceTotal()
    {
        return Money::of(FacadesCart::priceTotal(), 'VND')->formatTo('vn_VN');
    }
}