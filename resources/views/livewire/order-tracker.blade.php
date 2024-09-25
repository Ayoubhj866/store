<div>
    <div class="py-4">
        <x-mary-button label="Back to market" link="/" icon="o-arrow-long-left" spinner wire:navigate />
    </div>
    <div class="py-10 grid grid-col md:grid-cols-3 gap-6">
        <div>
            <img src="{{ asset('images/order-tracker.svg') }}" class="" alt="cart image">
        </div>
        @if ($this->order)
            <div>
                <x-mary-card title="Order #{{ $order->id }}" separator shadow>
                    {{-- list items here --}}
                    @foreach ($order->products as $product)
                        <ul class="max-w-md divide-y divide-gray-200 rounded-xl dark:divide-gray-700">
                            <a href="{{ route('showProduct', $product) }}">
                                <li class=" hover:bg-gray-100 py-6 px-2 rounded-xl">
                                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                        <div class="flex-shrink-0">
                                            <img class="w-8 h-8 rounded-full" src="{{ $product->image }}"
                                                alt="{{ $product->name }} image">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                {{ $product->name }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                {{ '$' . $product->pivot->unit_price }}
                                            </p>
                                        </div>
                                        <div
                                            class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                            <x-mary-badge value="{{ $product->pivot->quantity }}"
                                                class="badge-secondary mr-2 " />
                                        </div>
                                    </div>
                                </li>
                            </a>
                    @endforeach
                    <div class="flex justify-between items-center px-4 h-20">
                        <div>
                            <span>{{ $order->products->count() }} item(s)</span>
                        </div>
                        <div>
                            Total : <span class="font-extrabold text-black">{{ '$' . $order->total_amount }}</span>
                        </div>
                    </div>
                </x-mary-card>
            </div>

            <div>
                <x-mary-card title="Status" separator shadow>
                    <x-mary-timeline-item title="Order placed" first icon="o-map-pin" />
                    @if ($order->status == 'confirmed' || $order->status == 'shipped' || $order->status == 'delivered')
                        <x-mary-timeline-item title="Payment confirmed" icon="o-credit-card" />
                    @else
                        <x-mary-timeline-item title="Payment confirmed" pending icon="o-credit-card" />
                    @endif

                    @if ($order->status == 'shipped' || $order->status == 'delivered')
                        <x-mary-timeline-item title="Shipped" icon="o-paper-airplane" />
                    @else
                        <x-mary-timeline-item title="Shipped" pending icon="o-paper-airplane" />
                    @endif

                    @if ($order->status == 'delivered')
                        <x-mary-timeline-item title="Delivered" last icon="o-gift" />
                    @else
                        <x-mary-timeline-item title="Delivered" last pending icon="o-gift" />
                    @endif


                </x-mary-card>
            </div>
        @else
            <x-mary-card title="Order not found" separator progress-indicator>
                <x-mary-button label="Back to market" link="/" icon="o-arrow-long-left" spinner wire:navigate />
            </x-mary-card>
        @endif
    </div>
</div>
