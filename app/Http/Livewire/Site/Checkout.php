<?php

namespace App\Http\Livewire\Site;

use App\Enums\PaymentType;
use App\Enums\ShippingPaymentType;
use App\Http\Traits\VNPay;
use App\ValueObjects\Cart;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Checkout extends Component
{
    use VNPay;

    public bool $isShowPickAddressModal = false;
    public array $shippingAddress = [];
    public int $serviceTypeId = 1;
    public string $paymentType = 'cash';
    public string $recipientName = '';
    public string $recipientPhone = '';

    protected $listeners = ['pickAddressEvent'];


    protected $rules = [
        'serviceTypeId' => 'required',
        'paymentType' => 'required',
        'recipientName' => 'required',
        'recipientPhone' => 'required',
    ];

    public function render()
    {
        $cart = new Cart();
        $cart->calculateShippingFee($this->serviceTypeId);
        return view('livewire.site.checkout',  [
            'cart' => $cart,
            'services' => $cart->getServices(),
        ])->layout('layouts.site');
    }

    public function mount()
    {
        $this->serviceTypeId = session('service_type_id_ghn', 1);
    }

    public function pickAddressEvent($address)
    {
        $addresLineArray = [$address['homeAddress'], $address['ward']['wardName'], $address['district']['districtName'], $address['province']['provinceName']];
        $address['addressLine'] =  implode(', ', $addresLineArray);
        session(['shipping_address' => $address]);
        $this->isShowPickAddressModal = false;
    }

    public function updatedServiceTypeId($value)
    {
        session('service_type_id_ghn', $value);
    }

    public function checkout()
    {
        $this->shippingAddress = session('shipping_address', []);
        $this->validate(
            [
                'paymentType' => 'required',
                'serviceTypeId' => 'required',
                'shippingAddress.province' => 'required',
                'shippingAddress.district' => 'required',
                'shippingAddress.ward' => 'required',
                'shippingAddress.homeAddress' => 'required',
                'recipientName' => 'required',
                'recipientPhone' => 'required',
            ],
            [],
            [
                'shippingAddress.province' => 'Province',
                'shippingAddress.district' => "District",
                'shippingAddress.ward' => 'Ward',
                'shippingAddress.homeAddress' => 'home address'
            ]
        );

        $recipient = [
            'name' => $this->recipientName,
            'phone' => $this->recipientPhone,
            'address' => $this->shippingAddress['addressLine'],
            'ward_code' => $this->shippingAddress['ward']['wardCode'],
            'district_id' => $this->shippingAddress['district']['districtId'],
        ];

        $cart = new Cart();
        if ($this->paymentType == 'bank_transfer') {
            // cash payment process
            $order = $cart->createOrder($recipient, ShippingPaymentType::BUYER_PAY, PaymentType::BANK_TRANSFER, $this->serviceTypeId);
            $this->paymentVnp($order);
            // $cart->destroy();
            return;
        }
        if ($this->paymentType == 'cash') {
            // cash payment process
            $order = $cart->createOrder($recipient, ShippingPaymentType::BUYER_PAY, PaymentType::CASH, $this->serviceTypeId);
            $cart->destroy();
            $orderUrl = URL::signedRoute('site.checkout-success', ['order' => $order]);
            return redirect($orderUrl);
        }

    }
}
