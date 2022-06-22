<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectAddress extends Component
{
    public $provinceJson = '';
    public $districtJson = '';
    public $wardJson = '';

    public $province = [];
    public $district = [];
    public $ward = [];

    public $address = [];

    protected $rules = [
        'province' => 'required',
        'district' => 'required',
        'ward' => 'required'
    ];

    public function render()
    {
        return view('livewire.select-address');
    }


    public function updatedProvinceJson()
    {
        $this->province = (array)(json_decode($this->provinceJson) ?? []);
        $this->districtJson = '';
    }

    public function updatedDistrictJson()
    {
        $this->district = (array) (json_decode($this->districtJson) ?? []);
        $this->wardJson = '';
    }

    public function updatedWardJson()
    {
        $this->ward = (array) (json_decode($this->wardJson) ?? []);
    }

    public function selectedAddress()
    {
        $address = [
            'province' => $this->province,
            'district' => $this->district,
            'ward' => $this->ward,
        ];

        $this->emitUp('selectedAddress', $address);
    }
}
