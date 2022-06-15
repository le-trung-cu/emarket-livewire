<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\VariationOption;
use Livewire\Component;

class VariationOptionManager extends Component
{
    public Product $product;

    public bool $isShowFormForCreationModal = false;
    public bool $isShowConfirmDeleteModal = false;

    public ?VariationOption $optionForCreation = null;
    public ?VariationOption $optionForDeleting = null;

    protected $listeners = ['showConfirmDeleteModal'];

    protected function rules()
    {
        return [
            'optionForCreation.name' => 'required|string',
            'optionForCreation.visual' => 'required|string',
            'optionForCreation.product_id' => 'required',
        ];
    }
    
    public function render()
    {
        return view('livewire.admin.variation-option-manager');
    }

    public function create()
    {
        $this->validate(rules: null, messages: [], attributes: [
            'optionForCreation.name' => 'name',
            'optionForCreation.visual' => 'visual',
        ]);
        if($this->optionForCreation->save()){
            $this->isShowFormForCreationModal = false;
            $this->product->refresh();
        }
    }

    public function delete()
    {
        if($this->optionForDeleting->delete()){
            $this->isShowConfirmDeleteModal = false;
            $this->product->refresh();
        }
    }

    public function showFormForCreationModal()
    {
        $this->isShowFormForCreationModal = true;
        $this->optionForCreation = new VariationOption([
            'product_id' =>  $this->product->id,
        ]);
    }

    public function showConfirmDeleteModal(VariationOption $option)
    {
        $this->isShowConfirmDeleteModal = true;
        $this->optionForDeleting = $option;
    }
}
