<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class OrderDetail extends Component
{
    public Order $order;
    
    public function render()
    {
        return view('livewire.admin.order-detail');
    }
}
