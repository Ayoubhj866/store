<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;
use RealRashid\Cart\Facades\Cart;

class CartContent extends Component
{
    use Toast;

    #[Computed]
    public function items()
    {
        return Cart::all();
    }

    /**
     * removeFromCart : remove cart from cart
     *
     * @return void
     */
    public function removeFromCart($id)
    {
        Cart::remove($id);
        $this->error('Removed from cart!', position: 'bottom-end');
        $this->dispatch('cart-changed');
    }

    #[On(['card-changed', 'remove-item-from-cart'])]
    public function render()
    {
        return view('livewire.cart-content');
    }
}
