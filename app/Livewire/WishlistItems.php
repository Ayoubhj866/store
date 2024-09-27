<?php

namespace App\Livewire;

use Livewire\Component;
use Mary\Traits\Toast;

class WishlistItems extends Component
{
    use Toast;

    public function removeFromWishlist($id)
    {
        if ($id) {
            cart()->instance('wishlist')->remove($id);
            $this->info('Wishlist updated !', position: 'bottom-end', icon: 'o-exclamation-circle');

            return;
        }

        $this->error('Item not found!', position: 'bottom-end', icon: 'o-exclamation-circle');
    }

    public function render()
    {
        return view('livewire.wishlist-items');
    }
}
