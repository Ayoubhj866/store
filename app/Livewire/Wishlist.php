<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mary\Traits\Toast;
use RealRashid\Cart\Facades\Cart;

class Wishlist extends Component
{
    use Toast;

    public $product;

    public $exist = false;

    public function mount($product)
    {
        $this->product = $product;
    }

    /**
     * addToWishlist : add item to wishlist
     *
     * @return void
     */
    public function addToWishlist()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $product = $this->product;
        Cart::instance('wishlist')->add(id: $product->id, name: $product->name, quantity: 1, price: $product->price, options: [], taxrate: null)->associate($product->id, $this->product);
        $this->success('Added to wishlist !', position: 'bottom-end', icon: 'o-heart');
        // $this->dispatch('wishlist-updated');
    }

    /**
     * removeFromWishlist : remove item from wishlist
     *
     * @return void
     */
    public function removeFromWishlist()
    {
        Cart::instance('wishlist')->remove($this->product->id);
        $this->error('Removed from wishlist!', position: 'bottom-end', icon: 'o-heart');
        // $this->dispatch('wishlist-updated');
    }

    public function render()
    {
        return view('livewire.wishlist');
    }
}
