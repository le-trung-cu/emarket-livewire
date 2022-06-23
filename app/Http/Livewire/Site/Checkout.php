<?php

namespace App\Http\Livewire\Site;

use App\ValueObjects\Cart;
use Livewire\Component;

class Checkout extends Component
{
    public bool $isShowPickAddressModal = false;
    public $shippingAddress = [];
    public $serviceTypeId = 1;
    public $paymentTypeId = 1;

    protected $rules = [
        'serviceTypeId' => 'required',
        'paymentTypeId' => 'required',
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
                'paymentTypeId' => 'required',
                'serviceTypeId' => 'required',
                'shippingAddress.province' => 'required',
                'shippingAddress.district' => 'required',
                'shippingAddress.ward' => 'required',
                'shippingAddress.homeAddress' => 'required',
            ],
            [],
            [
                'shippingAddress.province' => 'Province',
                'shippingAddress.district' => "District",
                'shippingAddress.ward' => 'Ward',
                'shippingAddress.homeAddress' => 'home address'
            ]
        );

        if($this->paymentTypeId == 1) {
            // cash payment process
        }
    }
}
