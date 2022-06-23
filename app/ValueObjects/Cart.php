<?php

namespace App\ValueObjects;

use App\Http\Traits\GhnVn;
use App\Models\SKU;
use App\Models\StoreBranch;
use Brick\Money\Money;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;

class Cart
{

    use GhnVn;

    private $cart;
    public array $shippingFee = [];
    public $shippingOrders;
    public $cartItems;

    public function __construct()
    {
        $this->cart = FacadesCart::instance('cart');
        $cartContent = $this->cart->content();

        $skuIds = $cartContent->map(fn ($item) => $item->id);

        $skus = SKU::with('product.storeBranch')->find($skuIds);

        $skusGroupByStoreBranch = $skus->groupBy('product.storeBranch.id');

        // If cart contains product belong to orther store branch,
        // it should deliver multiple orther shipping service.
        $this->shippingOrders = $skusGroupByStoreBranch->map(
            fn ($skus) => $skus->map(fn ($sku) => new CartItem(
                $this->cart->search(fn ($cartItem, $rowId) => $cartItem->id === $sku->id)->first(),
                $sku
            )),
        );
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
        if ($this->shippingFee != null) {
            return Money::of(FacadesCart::priceTotal(), 'VND')
                ->plus(collect($this->shippingFee)->sum())
                ->formatTo('vn_VN');
        } else {
            return Money::of(FacadesCart::priceTotal(), 'VND')->formatTo('vn_VN');
        }
    }


    public function calculateShippingFee(int $serviceTypeId)
    {
        $this->shippingFee = [];
        $address = session('shipping_address', null);

        if ($address === null) {
            return;
        }

        foreach ($this->shippingOrders as $storeBranchId => $cartItems) {
            $weight = $cartItems->reduce(fn ($result, $item) => $result + $item->qty * $item->sku->weight, 0);
            $district_id = StoreBranch::find($storeBranchId)->district_id;
            $this->shippingFee[$storeBranchId] = $this->calculateFeeGhn([
                'weight' => $weight,
                'from_district_id' => $district_id,
                'to_district_id' => $address['district']['districtId'],
                'to_ward_code' => $address['ward']['wardCode'],
                'service_type_id' => $serviceTypeId,
            ]);
        }
    }

    public function shippingFeeFormat(int $storeBranchId = null)
    {
        if ($storeBranchId === null) {
            return Money::of(collect($this->shippingFee)->sum(), 'VND')->formatTo('vn_VN');
        } else {
            return Money::of($this->shippingFee[$storeBranchId], 'VND')->formatTo('vn_VN');
        }
    }

    public function weight()
    {
        return $this->cart->weight();
    }

    public function getServices()
    {
        $address = session('shipping_address', null);
        if ($address === null) {
            return [];
        }
        return $this->getServicesGhn(config('app.shop_district_id_ghn'), $address['district']['districtId']);
    }
}
