<div>

    {{-- header --}}
    <x-mary-header :title="$product->name" separator progress-indicator class="">
        <x-slot:actions>
            <x-mary-button icon="o-trash" class="btn-error" label="delete" responsive wire:click="delete"
                wire:confirm="Are you sure?" />
        </x-slot:actions>
    </x-mary-header>

    <form wire:submit="saveChanges">
        <div class="grid grid-col md:grid-cols-2 md:gap-x-4">
            {{-- product details --}}
            <x-mary-card title="Details" separator class="bg-white">
                <div class="space-y-4">
                    {{-- name --}}
                    <x-mary-input label="Name" wire:model="name" />

                    {{-- Brand --}}
                    <x-mary-choices label="Brand" icon="o-tag" wire:model.live="brandId" :options="$this->brands" single
                        class="!input:border-none">
                        <x-slot:append>
                            {{-- Add `rounded-e-none` (RTL support) --}}
                            <x-mary-button icon="o-plus" class="rounded-none h-full w-full rounded-r-sm btn-primary" />
                        </x-slot:append>
                    </x-mary-choices>

                    {{-- Category --}}
                    <x-mary-choices label="Category" icon="o-paper-clip" wire:model.live="categoryId" :options="$this->categories"
                        single>
                        <x-slot:append>
                            {{-- Add `rounded-e-none` (RTL support) --}}
                            <x-mary-button icon="o-plus" class="rounded-none h-full w-full rounded-r-sm btn-primary" />
                        </x-slot:append>
                    </x-mary-choices>

                    {{-- Price --}}
                    <x-mary-input label="Price" wire:model="price" prefix="USD" />

                    {{-- Description --}}
                    <x-mary-textarea label="Description" wire:model="description" placeholder="Product description ..."
                        hint="Max 1000 chars" rows="10" />
                </div>

            </x-mary-card>
            @php
                $imageUrl = false;
                if ($product->image != '') {
                    $imageUrl = str_contains($product->image, 'picsum.photos')
                        ? $product->image
                        : asset('storage/' . $product->image);
                }
            @endphp

            <div class="space-y-4">
                {{-- product Cover --}}
                <x-mary-card title="Cover" separator progress-indicator class="bg-white">
                    <x-mary-file wire:model="image" accept="image/png,jpg,jpeg" crop-after-change class="mx-auto">
                        @if ($imageUrl)
                            <img src="{{ $imageUrl }}" class="h-40 rounded-lg" />
                        @else
                            <img src="{{ asset('images/no-image.svg') }}" class="h-40 rounded-lg" />
                        @endif
                    </x-mary-file>
                </x-mary-card>


                {{-- product Cover --}}
                <x-mary-card title="" separator progress-indicator class="bg-white">
                    <div class="flex gap-2 justify-end w-full py-10">
                        <x-mary-button :link="route('products.management')" wire:navigate label="Cancel" icon="o-x-mark" responsive />
                        <x-mary-button label="Save changes" class="btn-primary" icon="o-bookmark-square" type="submit"
                            spinner="save" responsive />
                    </div>
                </x-mary-card>

            </div>
        </div>
    </form>
</div>
