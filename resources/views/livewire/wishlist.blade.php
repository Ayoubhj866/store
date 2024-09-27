<div>
    @if (cart()->instance('wishlist')->get($product->id))
        <x-mary-button icon="o-heart" class="px-4 text-error" wire:click="removeFromWishlist" />
    @else
        <x-mary-button icon="o-heart" class="px-4" wire:click="addToWishlist" />
    @endif
</div>
