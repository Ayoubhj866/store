<div>
    <div class="py-4">
        <x-mary-button label="Back to market" link="/" icon="o-arrow-long-left" spinner wire:navigate />
    </div>

    <div class="py-10 grid grid-col md:grid-cols-3 gap-4">
        <div>
            <img src="{{ asset('images/cart.svg') }}" class="" alt="cart image">
        </div>
        @if (Cart::count() > 0)
            <div>
                <x-mary-card title="Cart" separator shadow progress-indicator="removeItemFromCart">
                    {{-- list items here --}}
                    @foreach (Cart::all() as $item)
                        <ul class="max-w-md divide-y divide-gray-200 rounded-xl dark:divide-gray-700">
                            <li class=" hover:bg-gray-100 py-6 px-2 rounded-xl">
                                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                    <div class="flex-shrink-0">
                                        @php
                                            $imageUrl = str_contains($item->model->image, 'picsum.photos')
                                                ? $item->model->image
                                                : asset('storage/' . $item->model->image);
                                        @endphp
                                        <img src="{{ $imageUrl }}" class="w-8 h-8 rounded-full" />
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
                                        <x-mary-badge value="{{ $item->quantity }}" class="badge-error mr-2 " />

                                        {{-- remove item from cart  --}}
                                        <x-mary-button wire:click.stop="removeFromCart({{ $item->id }})"
                                            icon="o-trash" class="btn-circle btn-ghost btn-sm text-error" />
                                    </div>
                                </div>
                            </li>
                    @endforeach
                    <div @click.stop class="flex justify-between items-center px-4 h-20">
                        <div>
                            <span>{{ Cart::count() }} item(s)</span>
                        </div>
                        <div>
                            Total : <span class="font-extrabold text-black">{{ '$' . Cart::total() }}</span>
                        </div>
                    </div>
                </x-mary-card>
            </div>
            <div>
                <x-mary-card title="I am done" separator shadow>
                    <x-mary-button label="Chekout" :link="route('checkout')" icon-right="o-arrow-long-right"
                        class="bg-purple-600 hover:bg-purple-500 transition-all duration-200 text-white" />
                </x-mary-card>
            </div>
        @else
            <x-mary-card title="Cart Empty" separator progress-indicator>
                <x-mary-button label="Back to market" link="/" icon="o-arrow-long-left" spinner wire:navigate />
            </x-mary-card>
        @endif
    </div>
</div>
