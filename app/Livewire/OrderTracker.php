<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderTracker extends Component
{
    public Order $order;

    public function mount()
    {
        $this->order = Order::with('products', 'payment')->find($this->order->id);
    }

    public function render()
    {

        return view('livewire.order-tracker');
    }
}
