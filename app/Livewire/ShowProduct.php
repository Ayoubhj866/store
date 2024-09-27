<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;
use RealRashid\Cart\Facades\Cart;

class ShowProduct extends Component
{
    use Toast , WithoutMiddleware;

    public Product $product;

    /**
     * addToCart : add this product to cart
     *
     * @return void
     */
    public function addToCart()
    {
        $product = $this->product;
        Cart::add(id: $product->id, name: $product->name, quantity: 1, price: $product->price, options: [], taxrate: null)->associate($product->id, $this->product);
        $this->success('Added to cart !', position: 'bottom-end');
        $this->dispatch('cart-updated');
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
        $this->dispatch('cart-updated');
    }

    #[On(['remove-item-from-cart', 'cart-cleared'])]
    public function render()
    {
        return view('livewire.show-product');
    }
}
