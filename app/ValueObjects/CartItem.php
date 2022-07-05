<?php

namespace App\ValueObjects;

use App\Models\SKU;
use Brick\Money\Money;
use Gloudemans\Shoppingcart\CartItem as ShoppingcartCartItem;

class CartItem
{

    public ShoppingcartCartItem $cartItem;
    public SKU $sku;

    public $rowId, $thumbnail, $price_unit, $amount, $product_name, $qty, $id;

    public function __construct(ShoppingcartCartItem $cartItem, SKU $sku)
    {
        $currencyCode = config('settings.currency_code');
        
        $this->id = $cartItem->id;
        $this->cartItem = $cartItem;
        $this->sku = $sku;
        $this->product_name = $cartItem->name;
        $this->qty = $cartItem->qty;
        $this->rowId = $cartItem->rowId;
        $this->thumbnail = $this->sku->product->thumbnail;

        $this->price_unit = Money::of($this->cartItem->price, $currencyCode);
        $this->amount = Money::of($this->cartItem->price * $this->cartItem->qty, $currencyCode);
    }

    public function getVariantionString()
    {
        return 'CartItem.getVariantionString';
    }
}
