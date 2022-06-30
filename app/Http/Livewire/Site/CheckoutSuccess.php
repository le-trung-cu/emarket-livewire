<?php

namespace App\Http\Livewire\Site;

use App\Models\Order;
use Brick\Money\Money;
use Livewire\Component;

class CheckoutSuccess extends Component
{
    public Order $order;

    public function render()
    {
        $children = $this->order->children()->with('orderItems.sku.product')->get();
        $amountTotal = $this->order->amount
            ->plus(collect($children)->sum(fn($order) => $order->amount));

        $shippingFeeTotal = $this->order->shipping_fee
            ->plus(collect($children)->sum(fn($order) => $order->shipping_fee));

        $orderGroup = collect([$this->order])->concat($children);
        // dd($orderGroup, $amountTotal, $shippingFeeTotal);

        return view('livewire.site.checkout-success', [
            'orderGroup' => $orderGroup,
            'amountTotal' => $amountTotal,
            'shippingFeeTotal' => $shippingFeeTotal,
            'totalPrice' =>  $amountTotal->plus($shippingFeeTotal),
            'children' => $children,
            'paymentTypeId' => $this->order->payment_type,
        ])->layout('layouts.site');
    }
}
