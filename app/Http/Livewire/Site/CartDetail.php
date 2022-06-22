<?php

namespace App\Http\Livewire\Site;

use App\ValueObjects\Cart;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
use Livewire\Component;

class CartDetail extends Component
{
    public bool $isShowPickAddressModal = false;
    public $shippingAddress = [];
    public $serviceTypeId = 1;

    protected $rules = [
        'serviceTypeId' => 'required',
    ];

    protected $listeners = ['pickAddressEvent'];

    public function render()
    {
        $cart = new Cart();
        $cart->calculateShippingFee($this->serviceTypeId);
        return view('livewire.site.cart-detail', [
            'cart' => $cart,
            'services' => $cart->getServices(),
        ])->layout('layouts.site');
    }

    public function mount()
    {
        $this->serviceTypeId = session('service_type_id_ghn', 1);
    }

    public function updateCart($rowId, int $num)
    {
        FacadesCart::instance('cart')->update($rowId, $num);
        $this->emitTo('site.cart-icon', 'cartChanged');
    }

    public function pickAddressEvent($address)
    {
        $addresLineArray = [$address['homeAddress'], $address['ward']['wardName'], $address['district']['districtName'], $address['province']['provinceName'] ];
        $address['addressLine'] =  implode(', ', $addresLineArray);
        session(['shipping_address' => $address]);
        $this->isShowPickAddressModal = false;
    }

    public function updatedServiceTypeId($value)
    {
        session('service_type_id_ghn', $value);
    }
}
