<div>
    <div class="inline relative px-2">
        <x-mary-dropdown no-x-anchor label="Cart" icon="o-shopping-cart" right class="btn-ghost  btn-sm">
            @if (cart()->count() > 0)
                @foreach (Cart::all() as $item)
                    <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                        <li class=" hover:bg-gray-100 my-1">
                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="{{ $item->model->image }}"
                                        alt="{{ $item->name }} image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $item->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ '$' . $item->price }}
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{-- remove item from cart  --}}
                                    <x-mary-button wire:click.stop="removeItemFromCart({{ $item->id }})"
                                        icon="o-trash" class="btn-circle btn-ghost btn-sm text-error" />
                                </div>
                            </div>
                        </li>
                @endforeach
                <div @click.stop class="flex justify-between items-center px-4 h-20">
                    <div>
                        <span>{{ cart()->count() }} item(s)</span>
                    </div>
                    <div>
                        Total : <span class="font-extrabold text-black">{{ '$' . Cart::total() }}</span>
                    </div>
                </div>

                <div @click.stop class="flex w-[400px] justify-between items-center px-4 h-20">
                    <div>
                        <x-mary-button wire:click="clearCart" label="Trash cart" icon="o-trash"
                            class="btn-sm btn-ghost text-error" responsive spinner />
                    </div>

                    <div>
                        <x-mary-button wire:navigate label="Go to cart" icon="o-shopping-bag" :link="route('cart-content')"
                            class="btn-sm btn-purple" responsive spinner />
                    </div>
                </div>
            @else
                <div class="py-3 px-2">
                    Cart is empty !
                </div>
            @endif
        </x-mary-dropdown>
        <x-mary-badge value="{{ cart()->count() }}" class="badge-primary absolute -right-2 -top-2" />
    </div>
</div>
