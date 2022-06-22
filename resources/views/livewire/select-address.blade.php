<div class="grid grid-rows-4 gap-5">
    <x-select label="Select Province" wire:model="provinceJson" placeholder="Select Province" :async-data="route('address.provinces')"
        option-label="description" option-value="value" option-description="description" />
    <x-select disabled="{{ strlen($provinceJson) == 0 }}" label="Select District" wire:model="districtJson"
        placeholder="Select District" :async-data="[
            'api' => route('address.districts'),
            'params' => $province,
        ]" option-label="description" option-value="value"
        option-description="description" />

    <x-select disabled="{{ strlen($districtJson) == 0 }}" label="Select Ward" wire:model="wardJson"
        placeholder="Select Ward" :async-data="[
            'api' => route('address.wards'),
            'params' => $district,
        ]" option-label="description" option-value="value"
        option-description="description" />

    <x-input label="Home Address" placeholder="your home address" corner-hint="Optional" wire:model.lazy="homeAddress"/>
</div>
