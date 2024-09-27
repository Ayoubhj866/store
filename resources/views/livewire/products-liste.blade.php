<div>
    {{-- header --}}
    <div class="flex pt-6 gap-x-4 justify-start items-center">
        {{-- search input --}}
        <x-mary-input wire:model.live.debounce.300ms="search" class="max-w-sm" icon="o-magnifying-glass"
            placeholder="Search..." />

        {{-- filter by brand --}}
        <div class="relative">
            @if (isset($brand) && count($brand) > 0)
                <x-mary-badge value="{{ count($brand) }}" class="badge-primary absolute -right-2 z-40 -top-2" />
            @endif
            <x-mary-dropdown label="Brand" class="btn-outline border-blue-700" no-x-anchor>
                {{-- clear filter --}}
                <x-mary-menu-item wire:click.live="clearBrandFilter" icon="o-x-mark" title="Clear filter" />

                <x-mary-menu-separator />

                <x-mary-menu-item @click.stop="">
                    <x-mary-checkbox value="Apple" wire:model.live="brand" label="Apple" />
                </x-mary-menu-item>

                <x-mary-menu-item @click.stop="">
                    <x-mary-checkbox value="Samsung" wire:model.live="brand" label="Samsung" />
                </x-mary-menu-item>

                <x-mary-menu-item @click.stop="">
                    <x-mary-checkbox value="LG" wire:model.live="brand" label="LG" />
                </x-mary-menu-item>
            </x-mary-dropdown>
        </div>

        {{-- filter by category --}}
        <div class="relative">
            @if (isset($category) && count($category) > 0)
                <x-mary-badge value="{{ count($category) }}" class="badge-primary absolute -right-2 z-40 -top-2" />
            @endif
            <x-mary-dropdown label="Category" class="btn-outline border-blue-700 relative" no-x-anchor>
                {{-- clear category  filter --}}
                <x-mary-menu-item wire:click.live="clearCategoryFilter()" icon="o-x-mark" title="Clear filter" />

                <x-mary-menu-separator />

                <x-mary-menu-item @click.stop="">
                    <x-mary-checkbox value="Phone" wire:model.live="category" label="Phone" />
                </x-mary-menu-item>

                <x-mary-menu-item @click.stop="">
                    <x-mary-checkbox value="Sound" wire:model.live="category" label="Sound" />
                </x-mary-menu-item>

                <x-mary-menu-item @click.stop="">
                    <x-mary-checkbox value="Computer" wire:model.live="category" label="Computer" />
                </x-mary-menu-item>
            </x-mary-dropdown>
        </div>

        @if ((isset($category) && count($category) > 0) || (isset($brand) && count($brand) > 0))
            <div>
                <x-mary-button wire:click="clearFilter()" label="Clear filter" icon="o-x-mark" />
            </div>
        @endif
    </div>

    {{-- separator --}}
    <x-mary-header title="" separator progress-indicator />

    {{-- Product liste --}}
    @if (!$this->products->isEmpty())
        <div class="grid grid-col sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($this->products as $product)
                <x-mary-card wire:key="{{ $product->id }}" title="{{ '$' . $product->price }}">
                    {{ $product->name }}
                    <x-slot:figure>
                        <a href="{{ route('showProduct', $product) }}" wire:navigate>
                            <img src="{{ $product->image }}"
                                class="hover:scale-105 transition-transform duration-200" />
                        </a>
                    </x-slot:figure>
                    <x-slot:menu>
                        {{-- livewire component to manage wishliste --}}
                        <livewire:wishlist :$product />
                    </x-slot:menu>
                </x-mary-card>
            @endforeach
        </div>
    @else
        <div class="text-center">
            <img src="{{ asset('images/Empty-state.svg') }}" class="max-w-[500px] mx-auto max-h-[500px]"
                alt="Empty state image">
            <p>
                No Product found !
            </p>
        </div>
    @endif
</div>
