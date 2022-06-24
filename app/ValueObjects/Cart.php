<?php

namespace App\ValueObjects;

use App\Http\Traits\GhnVn;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SKU;
use App\Models\StoreBranch;
use Brick\Money\Money;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
use Illuminate\Support\Facades\DB;

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

    # shipping_payment_type: 1 or 2
    # payment_type 1 or 2
    public function createOrder(array $recipient, int $shippingPaymentTypeId, int $paymentTypeId, int $serviceTypeId)
    {
        $this->calculateShippingFee($serviceTypeId);
        try {
            DB::beginTransaction();
            $firstOrderId = null;
            foreach ($this->shippingOrders as $storeBranchId => $cartItems) {
                $order = Order::create([
                    'store_branch_id' => $storeBranchId,
                    'group_id' => $firstOrderId,
                    'amount' => collect($cartItems)->sum(fn ($item) => $item->amount()),
                    'shipping_fee' => $this->shippingFee[$storeBranchId],
                    'shipping_payment_type' => $shippingPaymentTypeId,
                    'payment_type' => $paymentTypeId,
                    'discount' => 0,
                    'service_type_id_ghn' => $serviceTypeId,
                    'recipient_name' => $recipient['name'],
                    'recipient_phone' => $recipient['phone'],
                    'shipping_address' => $recipient['address'],
                    'ward_code' => $recipient['ward_code'],
                    'district_id' => $recipient['district_id'],
                ]);
                if ($firstOrderId === null) {
                    $firstOrderId = $order->id;
                }

                foreach ($cartItems as $key => $cartItem) {
                    $order->orderItems()->create([
                        'price' => $cartItem->price_unit,
                        'qty' => $cartItem->qty,
                        'product_name' => $cartItem->name,
                        'variation_string' => $cartItem->getVariantionString(),
                        'sku_id' => $cartItem->id,
                    ]);
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
