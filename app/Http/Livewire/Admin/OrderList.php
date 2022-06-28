<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\GhnVn;
use App\Models\Order;
use Livewire\Component;

class OrderList extends Component
{
    use GhnVn;

    public string $orderStatus = 'all';
    public bool $isShowPrintOrderModal = false;
    public string $printOrderToken = '';

    protected $rules = [
        'orderStatus' => 'required',
        'isShowPrintOrderModal' => 'required',
        'printOrderToken' => 'required',
    ];

    protected $listeners = [
        'printOrder',
    ];

    public function render()
    {
        return view('livewire.admin.order-list');
    }

    public function activeTab(string $status)
    {
        $this->orderStatus = $status;
        $this->emitTo('admin.order-table', 'pg:eventRefresh-default');
    }

    public function printOrder(Order $order)
    {
        $this->printOrderToken =  $this->genPrintOrderTokenGhn($order) ?? '';
        $this->isShowPrintOrderModal = true;
    }
}
