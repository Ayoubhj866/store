<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;
use RealRashid\Cart\Facades\Cart;

class ShowProduct extends Component
{
    use Toast;

    public Product $product;

    /**
     * addToCart : add this product to cart
     *
     * @return void
     */
    public function addToCart()
    {
        // user shoud be logged in to add items to cart
        // if (! Auth::user()) {
        //     return redirect(route('login'));
        // }
        $product = $this->product;
        Cart::add(id: $product->id, name: $product->name, quantity: 1, price: $product->price, options: [], taxrate: null)->associate($product->id, $this->product);
        $this->success('Added to cart !', position: 'bottom-end');
        $this->dispatch('cart-changed');
    }

    /**
     * removeFromCart : remove cart from cart
     *
     * @return void
     */
    public function removeFromCart()
    {
        Cart::remove($this->product->id);
        $this->error('Removed from cart!', position: 'bottom-end');
        $this->dispatch('cart-changed');
    }

    #[On('remove')]
    public function test()
    {
        dd('testststst');
    }

    #[On('remove-item-from-cart')]
    public function render()
    {
        return view('livewire.show-product');
    }
}
