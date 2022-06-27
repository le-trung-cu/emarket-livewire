<?php

namespace App\ValueObjects;

use App\Enums\PaymentType;
use App\Enums\ShippingPaymentType;
use App\Http\Traits\GhnVn;
use App\Models\Order;
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
    public $weight;

    // The amount can be used to get the total price of all items in the cart before applying discount and taxes.
    public $amount;

    public function __construct()
    {
        $this->cart = FacadesCart::instance('cart');

        $this->amount = Money::of($this->cart->priceTotal(), 'VND');
        $this->weight = $this->cart->weight();

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

    // include priceTotal and shipping fee
    public function amountIncludeShippingFee()
    {
        if ($this->shippingFee != null) {
            return $this->amount
                ->plus(collect($this->shippingFee)->reduce(fn ($result, $item) => $result->plus($item), Money::of(0, 'VND')));
        } else {
            return $this->amount;
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
            $this->shippingFee[$storeBranchId] = Money::of($this->calculateFeeGhn([
                'weight' => $weight,
                'from_district_id' => $district_id,
                'to_district_id' => $address['district']['districtId'],
                'to_ward_code' => $address['ward']['wardCode'],
                'service_type_id' => $serviceTypeId,
            ]), 'VND');
        }
    }

    public function shippingFeeTotal()
    {
        return collect($this->shippingFee)->reduce(fn ($result, $item) => $result->plus($item), Money::of(0, 'VND'));
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
    public function createOrder(array $recipient, ShippingPaymentType $shippingPaymentType, PaymentType $paymentType, int $serviceTypeId)
    {
        $this->calculateShippingFee($serviceTypeId);
        try {
            DB::beginTransaction();
            $firstOrder = null;
            foreach ($this->shippingOrders as $storeBranchId => $cartItems) {
                $order = Order::create([
                    'store_branch_id' => $storeBranchId,
                    'group_id' => $firstOrder?->id,
                    'amount' =>  collect($cartItems)->reduce(fn ($result, $item) => $result->plus($item->amount), Money::of(0, 'VND'))->getAmount(),
                    'shipping_fee' => $this->shippingFee[$storeBranchId]->getAmount(),
                    'shipping_payment_type' => $shippingPaymentType,
                    'payment_type' => $paymentType,
                    'discount' => 0,
                    'service_type_id_ghn' => $serviceTypeId,
                    'recipient_name' => $recipient['name'],
                    'recipient_phone' => $recipient['phone'],
                    'shipping_address' => $recipient['address'],
                    'ward_code' => $recipient['ward_code'],
                    'district_id' => $recipient['district_id'],
                ]);
                if ($firstOrder === null) {
                    $firstOrder = $order;
                }

                foreach ($cartItems as $key => $cartItem) {
                    $order->orderItems()->create([
                        'price' => $cartItem->price_unit->getAmount(),
                        'qty' => $cartItem->qty,
                        'product_name' => $cartItem->product_name,
                        'variation_string' => $cartItem->getVariantionString(),
                        'sku_id' => $cartItem->id,
                    ]);
                }
            }
            DB::commit();
            return $firstOrder;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy()
    {
        FacadesCart::instance('cart');
        FacadesCart::destroy();
    }
}
