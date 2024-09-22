<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;
use RealRashid\Cart\Facades\Cart;

class CartItems extends Component
{
    use Toast;

    public $count;

    public function boot()
    {
        $this->updateCartCount();
    }

    public function removeItemFromCart($id)
    {
        if (Cart::get($id)) {
            Cart::remove($id);
            $this->updateCartCount();
            $this->error('Removed from cart!', position: 'bottom-end');
            $this->dispatch('remove-item-from-cart');
        } else {
            $this->error('Item not found !', position: 'bottom-end');
        }
    }

    #[On(['cart-changed', 'removeItemFromCart'])]
    public function refreshCart()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        $this->count = Cart::count();
    }

    public function render()
    {
        return view('livewire.cart-items');
    }
}
