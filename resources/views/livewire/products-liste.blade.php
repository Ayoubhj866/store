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
            <x-mary-dropdown label="Brand" class="relative" no-x-anchor>
                {{-- clear filter --}}
                <x-mary-menu-item wire:click.live="clearBrandFilter" icon="o-x-mark" title="Clear filter" />

                <x-mary-menu-separator />
                <div class="max-h-96 overflow-auto">
                    @foreach ($this->brands as $brd)
                        <x-mary-menu-item wire:key="brand-{{ $brd->id }}" @click.stop="">
                            <x-mary-checkbox :value="$brd->id" wire:model.live="brand" :label="$brd->name" />
                        </x-mary-menu-item>
                    @endforeach
                </div>

            </x-mary-dropdown>
        </div>

        {{-- filter by category --}}
        <div class="relative">
            @if (isset($category) && count($category) > 0)
                <x-mary-badge value="{{ count($category) }}" class="badge-primary absolute -right-2 z-40 -top-2" />
            @endif

            <x-mary-dropdown label="Category" class=" relative" no-x-anchor>

                {{-- clear category  filter --}}
                <x-mary-menu-item wire:click.live="clearCategoryFilter()" icon="o-x-mark" title="Clear filter" />

                <x-mary-menu-separator />
                <div class="max-h-96 overflow-auto scroll-m-1">
                    @foreach ($this->categories as $cat)
                        <x-mary-menu-item wire:key="cat-{{ $cat->id }}" @click.stop="">
                            <x-mary-checkbox :value="$cat->id" wire:model.live="category" :label="$cat->name" />
                        </x-mary-menu-item>
                    @endforeach
                </div>

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
                    <x-slot:figure class="">

                        @php
                            $imageUrl = str_contains($product->image, 'picsum.photos')
                                ? $product->image
                                : asset('storage/' . $product->image);
                        @endphp

                        <a href="{{ route('showProduct', $product) }}" wire:navigate class=min-h-[250px] flex">
                            <img src="{{ $imageUrl }}" class="hover:scale-105 transition-transform duration-200"
                                class="h-full w-full" />
                        </a>
                    </x-slot:figure>
                    <x-slot:menu>
                        {{-- livewire component to manage wishliste --}}
                        <livewire:wishlist :$product wire:key="wishlist-{{ $product->id }}" />
                    </x-slot:menu>
                </x-mary-card>
            @endforeach
        </div>

        {{-- load more indicator --}}
        <div x-intersect.full="$wire.loadMore()" class="py-10">
            <div wire:loading wire:target='loadMore' class="flex w-full items-center justify-center">
                <span class="flex w-full items-center gap-2  justify-center">
                    <x-mary-loading class="loading-bars" />
                </span>
            </div>
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
