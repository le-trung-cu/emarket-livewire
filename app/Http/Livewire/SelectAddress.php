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
    public $homeAddress = '';
    public $address = [];

    protected $rules = [
        'province' => 'required',
        'district' => 'required',
        'ward' => 'required',
        'homeAddress' => 'nullable',
    ];

    protected $listeners = ['pickAddressEvent'];

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

    public function pickAddressEvent()
    {
        $address = [
            'province' => $this->province,
            'district' => $this->district,
            'ward' => $this->ward,
            'homeAddress' => $this->homeAddress,
        ];

        $this->emitUp('pickAddressEvent', $address);
    }
}
