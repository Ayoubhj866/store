<div>
    <div class="py-10">
        <x-mary-button label="Back to market" link="/" icon="o-arrow-long-left" spinner wire:navigate />
    </div>
    <div class="py-10 grid grid-col md:grid-cols-3 gap-10">
        <div>
            <img src="{{ asset('images/orders.svg') }}" class="" alt="order lists image">
        </div>

        @if (!$this->orders->isEmpty())
            <x-mary-card title="Your Orders" class="col-span-2" separator progress-indicator>
                {{-- foreach all orders --}}
                @foreach ($this->orders as $order)
                    <x-mary-list-item :item="$this->orders" no-separator class="cursor-pointer rounded-xl mb-2 bg-gray-100">
                        <x-slot:value>
                            Order #{{ $order->id }} - <span class="text-gray-500 text-sm font-light">
                                {{ $order->products->count() }}
                                item(s) </span>
                        </x-slot:value>
                        <x-slot:sub-value>
                            {{ $order->created_at->format('d M Y') }} -
                            {{ $order->created_at->diffForHumans() }}
                        </x-slot:sub-value>
                        <x-slot:actions>
                            <div>
                                {{-- order status --}}
                                <x-mary-badge :value="'order ' . $order->status" class="badge-{{ $orderStatus['shipped'] }} text-white"
                                    tooltip="Visite Order tracker" />

                                {{-- Track Order --}}
                                <x-mary-button wire:click="trackOrder({{ $order->id }})" label="Track Order"
                                    icon-right="o-truck" class="btn-purple  btn-sm"
                                    spinner="trackOrder({{ $order->id }})"></x-mary-button>
                            </div>
                        </x-slot:actions>
                    </x-mary-list-item>
                @endforeach
            </x-mary-card>
        @else
            <x-mary-card title="Cart is Empty" separator progress-indicator>
                <x-mary-button label="Back to market" link="/" icon="o-arrow-long-left" spinner wire:navigate />
            </x-mary-card>
        @endif
    </div>
</div>
