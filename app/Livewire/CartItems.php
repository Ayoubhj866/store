<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;
use RealRashid\Cart\Facades\Cart;

class CartItems extends Component
{
    use Toast;

    public $count = 0;

    /**
     * removeItemFromCart : remove item from cart
     *
     * @param  mixed  $id
     * @return void
     */
    public function removeItemFromCart($id)
    {
        if (Cart::get($id)) {
            Cart::remove($id);
            $this->error('Removed from cart!', position: 'bottom-end');
            $this->dispatch('remove-item-from-cart');
        } else {
            $this->error('Item not found !', position: 'bottom-end');
        }
    }

    /**
     * clearCart : clear all items from cart
     *
     * @return void
     */
    public function clearCart()
    {
        Cart::clear();
        $this->info('Cart Cleared !', position: 'bottom-end');
        $this->dispatch('cart-cleared');
    }

    #[On('cart-updated')]
    public function refresh()
    {
        $this->count = Cart::count();
    }

    public function render()
    {
        return view('livewire.cart-items');
    }
}
