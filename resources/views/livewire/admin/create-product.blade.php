<div>
    {{-- header --}}
    <x-mary-header title="Create product" separator progress-indicator class="" />
    <form wire:submit="create">
        <div class="grid grid-col md:grid-cols-2 md:gap-x-4">
            {{-- product details --}}
            <x-mary-card title="Details" separator class="bg-white">
                <div class="space-y-4">
                    {{-- name --}}
                    <x-mary-input label="Name" wire:model="name" />

                    {{-- Description --}}
                    <x-mary-textarea label="Description" wire:model="description" hint="Max 1000 chars" rows="10" />

                    {{-- Category --}}
                    <x-mary-choices label="Category" icon="o-paper-clip" wire:model="categoryId" :options="$this->categories"
                        single>
                        <x-slot:append>
                            <x-mary-button icon="o-plus" class="rounded-none h-full w-full rounded-r-sm btn-primary" />
                        </x-slot:append>
                    </x-mary-choices>

                    {{-- Category --}}
                    <x-mary-choices label="Brand" icon="o-paper-clip" wire:model="brandId" :options="$this->brands" single>
                        <x-slot:append>
                            <x-mary-button icon="o-plus" class="rounded-none h-full w-full rounded-r-sm btn-primary" />
                        </x-slot:append>
                    </x-mary-choices>



                    {{-- Price --}}
                    <x-mary-input label="Price" wire:model="price" prefix="USD" />
                </div>
            </x-mary-card>

            {{-- product Cover --}}
            <div class="space-y-4">
                <x-mary-card title="Cover" separator progress-indicator class="bg-white">
                    <x-mary-file wire:model="image" accept="image/png,jpg,jpeg" crop-after-change class="mx-auto">
                        <img src="{{ asset('images/no-image.svg') }}" class="h-40 rounded-lg" />
                    </x-mary-file>
                </x-mary-card>


                {{-- Actions --}}
                <x-mary-card title="" separator progress-indicator class="bg-white">
                    <div class="flex gap-2 justify-end w-full py-10">
                        <x-mary-button :link="route('products.management')" wire:navigate label="Cancel" icon="o-x-mark" responsive />
                        <x-mary-button label="Save changes" class="btn-success" icon="o-bookmark-square" type="submit"
                            spinner="create" responsive />
                    </div>
                </x-mary-card>
            </div>
        </div>
    </form>
</div>
