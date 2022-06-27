<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class OrderList extends Component
{
    public string $orderStatus = 'all';

    protected $rules = [
        'orderStatus' => 'required',
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
}
