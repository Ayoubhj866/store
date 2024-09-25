<div>
    <div class="py-10">
        <x-mary-button label="Back to market" link="/" icon="o-arrow-long-left" spinner wire:navigate />
    </div>
    <div class="grid grid-col md:gap-x-10 md:grid-cols-2">
        <div>
            <x-mary-card>
                <x-slot:figure class="mt-4">
                    <img src="{{ $product->image }}" />
                </x-slot:figure>
            </x-mary-card>
        </div>
        <div>
            {{-- Notice `progress-indicator` --}}
            <x-mary-card title="{{ $product->name }}" class="bg-transparent" separator progress-indicator>
                <div class="flex flex-col gap-4">
                    <x-mary-badge value="{{ '$' . $product->price }}" class="badge-neutral" />

                    <div class="mt-4">

                        @if (Cart::get($product->id))
                            {{-- remove from cart --}}
                            <x-mary-button spinner label="Remove from cart" class="btn-error" icon="o-trash"
                                wire:click="removeFromCart" />
                        @else
                            {{-- add to cart --}}
                            <x-mary-button spinner label="Add to cart" class="btn-purple" icon="o-shopping-cart"
                                wire:click="addToCart" />
                        @endif
                        {{-- wishlist --}}
                        <x-mary-button spinner icon="o-heart" class="px-4" tooltip="wishlist" />
                    </div>
                </div>
                <div class="mt-7">
                    <p>
                        {{ $product->description }}
                    </p>
                </div>
            </x-mary-card>
        </div>
    </div>
</div>
