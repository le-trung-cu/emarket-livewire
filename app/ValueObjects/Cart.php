<?php

namespace App\ValueObjects;

use App\Http\Traits\GhnVn;
use App\Models\SKU;
use Brick\Money\Money;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;

class Cart
{

    use GhnVn;

    private $cart;
    private $shippingFee = 0;

    public $cartItems;

    public function __construct()
    {
        $this->cart = FacadesCart::instance('cart');
        $cartContent = $this->cart->content();
        $skuIds = $cartContent->map(fn ($item) => $item->id);
        $mapSkuIds = SKU::find($skuIds)->mapWithKeys(fn ($item, $key) => [$item['id'] => $item]);
        $this->cartItems = $cartContent->map(fn ($item) => new CartItem($item, $mapSkuIds[$item->id]));
    }

    // The priceTotal() method can be used to get the total price of all items in the cart before
    // applying discount and taxes. The priceTotal() method can be used to get the total price of
    // all items in the cart before applying discount and taxes.
    public function priceTotalFormat()
    {
        return Money::of(FacadesCart::priceTotal(), 'VND')->formatTo('vn_VN');
    }

    // include priceTotal and shipping fee
    public function totalFormat()
    {
        if($this->shippingFee != null) {
            return Money::of(FacadesCart::priceTotal(), 'VND')
            ->plus($this->shippingFee)
            ->formatTo('vn_VN');
        }else {
            return Money::of(FacadesCart::priceTotal(), 'VND')->formatTo('vn_VN');
        }
    }


    public function calculateShippingFee(int $serviceTypeId)
    {
        $address = session('shipping_address', null);

        if ($address === null) {
            $this->shippingFee = null;
            return;
        }
        
        $this->shippingFee = $this->calculateFeeGhn([
            'weight' => (int) $this->cart->weight(),
            'from_district_id' => (int) config('app.shop_district_id_ghn'),
            'to_district_id' => $address['district']['districtId'],
            'to_ward_code' => $address['ward']['wardCode'],
            'service_type_id' => $serviceTypeId,
        ]);
    }

    public function shippingFeeFormat()
    {
        if($this->shippingFee !== null){
            return Money::of($this->shippingFee, 'VND')->formatTo('vn_VN');
        }
    }

    public function weight()
    {
        return $this->cart->weight();
    }

    public function getServices()
    {
        $address = session('shipping_address', null);
        if($address === null){
            return [];
        }
        return $this->getServicesGhn(config('app.shop_district_id_ghn'), $address['district']['districtId']);
    }
}
