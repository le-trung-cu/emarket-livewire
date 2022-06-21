<?php

namespace App\ValueObjects;

use App\Models\SKU;
use Brick\Money\Money;
use Gloudemans\Shoppingcart\CartItem as ShoppingcartCartItem;

class CartItem {

    private ShoppingcartCartItem $cartItem;
    public SKU $sku;
    
    public $rowId, $thumbnail, $price_unit, $price_total, $name, $qty;

    public function __construct(ShoppingcartCartItem $cartItem, SKU $sku)
    {
        $this->cartItem = $cartItem;
        $this->sku = $sku;
        $this->thumbnail = $this->sku->product->thumbnail;
        $this->price_unit = Money::of($cartItem->price, 'VND')->formatTo('vn_VN');
        $this->price_total = Money::of($cartItem->price * $cartItem->qty, 'VND')->formatTo('vn_VN');
        $this->name = $cartItem->name;
        $this->qty = $cartItem->qty;
        $this->rowId = $cartItem->rowId;
    }
}