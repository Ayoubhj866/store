<div>
    <div class="py-4">
        <x-mary-button label="Back to market" link="/" icon="o-arrow-long-left" spinner wire:navigate />
    </div>

    <div class="py-10 grid grid-col md:grid-cols-3 gap-4">
        <div>
            <img src="{{ asset('images/giveaway.svg') }}" class="" alt="cart image">
        </div>
        @if (Cart::instance('wishlist')->count() > 0)
            <div class="">
                <x-mary-card title="Wishlist" separator shadow progress-indicator="removeItemFromCart">
                    {{-- list items here --}}
                    <ul class="max-w-md divide-y divide-gray-200 rounded-xl dark:divide-gray-700">
                        @foreach (Cart::instance('wishlist')->all() as $item)
                            @php
                                $productInstance = new App\Models\Product();
                                $product = $productInstance->find(1);
                            @endphp
                            <li wire:key="{{ $item->id }}" class=" hover:bg-gray-100 py-6 px-2 rounded-xl">
                                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                    <div class="flex-shrink-0">
                                        <img class="w-8 h-8 rounded-full" src="{{ $item->model->image }}"
                                            alt="{{ $item->name }} image">
                                    </div>
                                    <a href="{{ route('showProduct', $product) }}" class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $item->name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{ '$' . $item->price }}
                                        </p>
                                    </a>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">

                                        {{-- remove item from cart  --}}
                                        <x-mary-button wire:click="removeFromWishlist({{ $item->id }})"
                                            icon="o-trash" class="btn-circle btn-ghost btn-sm text-error" />
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </x-mary-card>
            </div>
        @else
            <x-mary-card title="Wishlist is Empty" separator progress-indicator>
                <x-mary-button label="Back to market" link="/" icon="o-arrow-long-left" spinner wire:navigate />
            </x-mary-card>
        @endif
    </div>
</div>
