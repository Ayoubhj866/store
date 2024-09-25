<div>
    <div class="py-4">
        <x-mary-button label="Back to market" link="/" icon="o-arrow-long-left" spinner wire:navigate />
    </div>
    <div class="py-10 grid grid-col md:grid-cols-3 gap-4">
        <div>
            <img src="{{ asset('images/checkout.svg') }}" class="" alt="cart image">
        </div>
        @if (Cart::count() > 0)
            <div>
                <x-mary-card title="Checkout" separator shadow>
                    {{-- list items here --}}
                    @foreach (Cart::all() as $item)
                        <ul class="max-w-md divide-y divide-gray-200 rounded-xl dark:divide-gray-700">
                            <li class=" hover:bg-gray-100 py-6 px-2 rounded-xl">
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
                                        <x-mary-badge value="{{ $item->quantity }}" class="badge-secondary mr-2 " />
                                    </div>
                                </div>
                            </li>
                    @endforeach
                    <div class="flex justify-between items-center px-4 h-20">
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
                <x-mary-card title="Payment" separator shadow progress-indicator="checkout">
                    {{-- Card numebr and cvc number --}}
                    <x-mary-input wire:model="card_number" label="Card Number / CVC" placeholder="Card number / CVC "
                        prefix="Visa" x-mask="9999 9999 9999 9999 / 999">
                    </x-mary-input>

                    <div class="flex justify-end">
                        <x-mary-button label="Check" wire:click="checkout" icon-right="o-paper-airplane"
                            class="btn-purple transition-all duration-200 text-white mt-6" spinner />
                    </div>
                </x-mary-card>
            </div>
        @else
            <x-mary-card title="Cart is Empty" separator progress-indicator>
                <x-mary-button label="Back to market" link="/" icon="o-arrow-long-left" spinner wire:navigate />
            </x-mary-card>
        @endif
    </div>
</div>
