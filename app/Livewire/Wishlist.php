<?php

namespace App\Livewire;

use Livewire\Component;

class Wishlist extends Component
{
    public $product;

    public function moun($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.wishlist');
    }
}
