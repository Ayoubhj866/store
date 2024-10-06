<div>
    <div class="w-full p-4 rounded-xl h-full bg-white">
        {{-- header --}}
        <x-mary-header title="Products" separator progress-indicator class="">
            <x-slot:middle class="!justify-end">
                <x-mary-input icon="o-magnifying-glass" wire:model.live.debounce.300ms="search" placeholder="Product..." />
            </x-slot:middle>
            <x-slot:actions>
                {{-- <x-mary-button icon="o-funnel" label="Filters" responsive @click="$wire.filterDrawer = true" /> --}}
                @include('livewire.includes.products-filter-actions')
                <x-mary-button icon="o-plus" class="btn-primary" label="Create" responsive />
            </x-slot:actions>
        </x-mary-header>

        {{-- FIlter drower --}}
        <x-mary-drawer wire:model="filterDrawer" title="Filter" subtitle="Filter products" separator with-close-button
            close-on-escape class="w-11/12 lg:w-1/3" right>
            <div>Inputes here !</div>

            <x-slot:actions>
                <x-mary-button label="Cancel" @click="$wire.filterDrawer = false" />
                <x-mary-button label="Confirm" class="btn-primary" icon="o-check" />
            </x-slot:actions>
        </x-mary-drawer>

        {{-- content  --}}
        <div class="py-10">
            <x-mary-table :headers="$headers" :rows="$this->products" with-pagination :sort-by="$sortBy" striped
                link="/products/{name}/edit">
                @scope('cell_image', $objet)
                    @php
                        $imageUrl = str_contains($objet->image, 'picsum.photos')
                            ? $objet->image
                            : asset('storage/' . $objet->image);
                    @endphp
                    <x-mary-avatar :image="$imageUrl" class="!w-12 !rounded-lg" />
                @endscope

                @scope('cell_price', $objet)
                    $ {{ $objet->price }}
                @endscope

                {{-- Empty state --}}
                <x-slot:empty>
                    <x-mary-icon name="o-cube" label="It is empty." />
                </x-slot:empty>

            </x-mary-table>

        </div>

    </div>


</div>
