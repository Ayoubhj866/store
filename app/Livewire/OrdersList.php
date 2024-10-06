<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Mary\Traits\Toast;

class OrdersList extends Component
{
    use Toast;

    public $orderStatus = [
        'placed' => 'neutral',
        'confirmed' => 'ghost',
        'shipped' => 'primary',
        'delivered' => 'success',
        'cancelled' => 'error',
    ];

    /**
     * trackOrder : redirect user to visite order track
     *
     * @param  mixed  $id
     * @return void
     */
    public function trackOrder($id)
    {
        if ($order = Order::find($id)) {
            return redirect()->route('order-tracker', $order);
        }

        $this->error("We can't found order !", position: 'bottom-end');
    }

    #[Computed]
    public function orders()
    {
        return auth()->user()->orders()->with('products')->get();
    }

    public function render()
    {
        return view('livewire.orders-list');
    }
}
