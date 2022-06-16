<?php

namespace App\Http\Livewire\Admin;

use App\Models\VariationOption;
use App\Models\VariationValue;
use Livewire\Component;

class VariationValueManager extends Component
{
    public VariationOption $option;
    public VariationValue $variationValue;
    public bool $showConfirmDeleteVariationModal = false;
    public ?VariationValue $variationForDeleting = null;
    
    protected $listeners = ['comfirmDeleteVariation'];

    protected $rules = [
        'variationValue.value' => 'required|string',
        'variationValue.label' => 'required|string',
        'option.id' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.variation-value-manager');
    }

    public function mount(VariationOption $option)
    {
        $this->option = $option;
        $this->variationValue = new VariationValue();
        $this->variationValue->variation_option_id = $option->id;
    }

    public function create()
    {
        $this->validate();
        $this->variationValue->variation_option_id = $this->option->id;
        $this->variationValue->save();

        $this->variationValue = new VariationValue();
        $this->variationValue->variation_option_id = $this->option->id;
        $this->option->refresh();

        $this->emitTo('admin.sku-manager', 'admin.sku-manager:eventRefresh');
    }

    public function delete()
    {
        if($this->variationForDeleting->delete()){
            $this->showConfirmDeleteVariationModal = false;
            $this->option->refresh();
            $this->emitTo('admin.sku-manager', 'admin.sku-manager:eventRefresh');
        }
    }

    public function comfirmDeleteVariation(VariationValue $value)
    {
        $this->showConfirmDeleteVariationModal = true;
        $this->variationForDeleting = $value;
    }
}
