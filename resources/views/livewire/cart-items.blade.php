<div>
    <div class="inline relative px-2">
        <x-mary-dropdown label="Cart" icon="o-shopping-cart" right class="btn-ghost btn-sm">
            {{-- All itms added on card here --}}
            {{-- <x-mary-list-item :item="$user2" no-separator no-hover>
                                <x-slot:avatar>
                                    <x-mary-badge value="top user" class="badge-primary" />
                                </x-slot:avatar>
                                <x-slot:value>
                                    Custom value
                                </x-slot:value>
                                <x-slot:sub-value>
                                    Custom sub-value
                                </x-slot:sub-value>
                                <x-slot:actions>
                                    <x-mary-button icon="o-trash" class="text-red-500" wire:click="delete(1)" spinner />
                                </x-slot:actions>
                            </x-mary-list-item> --}}
            <div class="hidden py-3 px-2">
                Cart is empty !
            </div>
        </x-mary-dropdown>
        <x-mary-badge value="0" class="badge-primary absolute -right-2 -top-2" />
    </div>
</div>
