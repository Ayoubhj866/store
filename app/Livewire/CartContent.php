<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use RealRashid\Cart\Facades\Cart;

class CartContent extends Component
{
    #[Computed]
    public function items()
    {
        return Cart::all();
    }

    public function render()
    {
        return view('livewire.cart-content');
    }
}
