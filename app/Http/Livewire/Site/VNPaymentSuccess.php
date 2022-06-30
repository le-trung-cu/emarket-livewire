<?php

namespace App\Http\Livewire\Site;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\PaymentType;
use App\Http\Traits\VNPay;
use App\Models\Order;
use Brick\Money\Money;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Livewire\Component;

class VNPaymentSuccess extends Component
{
    use VNPay;

    public Order $order;

    public function render()
    {
        $children = $this->order->children()->with('orderItems.sku.product')->get();
        $amountTotal = $this->order->amount->plus(collect($children)->sum(fn($order) => $order->amount));

            $shippingFeeTotal = $this->order->shipping_fee
            ->plus(collect($children)->sum(fn($order) => $order->shipping_fee));

        $orderGroup = collect([$this->order])->concat($children);

        switch ($this->order->payment_type) {
            case PaymentType::CASH:
                $paymentType = 'cash';
                break;
            case PaymentType::BANK_TRANSFER:
                $paymentType = 'bank_transfer';
                break;
            default:
                # code...
                break;
        }
        return view('livewire.site.vnpayment-success', [
            'orderGroup' => $orderGroup,
            'amountTotal' => $amountTotal,
            'shippingFeeTotal' => $shippingFeeTotal,
            'totalPrice' =>  $amountTotal->plus($shippingFeeTotal),
            'children' => $children,
            'paymentType' => $paymentType,
        ])->layout('layouts.site');
    }

    public function mount(Request $request)
    {
        $checkResult = $this->checkSumReturnUrl();
        switch ($checkResult) {
            case 1:
                Cart::instance('cart');
                Cart::destroy();
                $orderId = $request->get('vnp_TxnRef');
                $this->order = Order::findOrFail($orderId);
                $this->order->payment_status = PaymentStatus::SUNCCESS;
                $this->order->save();
                break;
            case 0:
                dd('GD Thanh cong');
                break;
            case -1:
                dd('Chu ky khong hop le');
                break;
        }
    }
}
