<?php

namespace App\ValueObjects;

use App\Models\SKU;
use Brick\Money\Money;
use Gloudemans\Shoppingcart\CartItem as ShoppingcartCartItem;

class CartItem {

    private ShoppingcartCartItem $cartItem;
    public SKU $sku;
    
    public $rowId, $thumbnail, $price_unit, $price_total, $name, $qty, $id;

    public function __construct(ShoppingcartCartItem $cartItem, SKU $sku)
    {
        $this->id = $cartItem->id;
        $this->cartItem = $cartItem;
        $this->sku = $sku;
        $this->thumbnail = $this->sku->product->thumbnail;
        $this->price_unit = $this->cartItem->price;
        $this->price_total = $cartItem->price * $cartItem->qty;
        $this->name = $cartItem->name;
        $this->qty = $cartItem->qty;
        $this->rowId = $cartItem->rowId;
    }

    public function priceUnitFormat()
    {
        return Money::of($this->cartItem->price, 'VND')->formatTo('vn_VN');
    }

    public function priceTotalFormat()
    {
        return  Money::of($this->cartItem->price * $this->cartItem->qty, 'VND')->formatTo('vn_VN');
    }

    public function amount()
    {
        return $this->cartItem->price * $this->cartItem->qty;
    }

    public function getVariantionString()
    {
        return 'CartItem.getVariantionString';
    }
}