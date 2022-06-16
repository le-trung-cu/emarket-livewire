<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use App\Models\SKU;
use Livewire\Component;

class SkuManager extends Component
{
    public Product $product;
    public bool $isShowFormForAddSkuModal = false;
    public bool $isShowConfirmDeleteSkuModal = false;
    public ?SKU $skuForDeleting = null;

    protected $listeners = ['openAddSkuModalEvent', 'showConfirmDeleteSkuModalEvent', 'skuAddedEvent', 'admin.sku-manager:eventRefresh' => 'refresh'];

    public function render()
    {
        return view('livewire.admin.sku-manager');
    }

    public function openAddSkuModalEvent($params)
    {
        if($this->product->variationValues()->exists()){
            $this->isShowFormForAddSkuModal = true;
        }else {
            SKU::create([
                'product_id' => $this->product->id,
            ]);
            $this->refresh();
        }
    }

    public function skuAddedEvent()
    {
        $this->isShowFormForAddSkuModal = false;
        $this->refresh();
        // $this->emitTo('admin.product-sku-table', 'pg:eventRefresh-default');
    }

    public function delete()
    {
        if ($this->skuForDeleting->delete()) {
            $this->isShowConfirmDeleteSkuModal = false;
            $this->refresh();
            // $this->emitTo('admin.product-sku-table', 'pg:eventRefresh-default');
        }
    }

    public function showConfirmDeleteSkuModalEvent(SKU $sku)
    {
        $this->isShowConfirmDeleteSkuModal = true;
        $this->skuForDeleting = $sku;
    }

    public function refresh()
    {
        $this->emitTo('admin.product-sku-table', 'pg:eventRefresh-default');
    }
}
