{{-- Clear filter --}}
@if ((isset($categories) && count($categories) > 0) || (isset($brands) && count($brands) > 0))
    <div>
        <x-mary-button wire:click="clearFilter()" label="Clear filter" icon="o-x-mark" />
    </div>
@endif

{{-- filter by brand --}}
<div class="relative">
    @if (isset($brands) && count($brands) > 0)
        <x-mary-badge value="{{ count($brands) }}" class="badge-primary absolute -right-2 z-40 -top-2" />
    @endif
    <x-mary-dropdown label="Brand" class="relative" no-x-anchor>
        {{-- clear filter --}}
        <x-mary-menu-item wire:click.live="clearBrandFilter" icon="o-x-mark" title="Clear filter" />

        <x-mary-menu-separator />
        <div class="max-h-96 overflow-auto">
            @foreach ($this->getBrands as $brd)
                <x-mary-menu-item wire:key="brand-{{ $brd->id }}" @click.stop="">
                    <x-mary-checkbox :value="$brd->id" wire:model.live="brands" :label="$brd->name" />
                </x-mary-menu-item>
            @endforeach
        </div>

    </x-mary-dropdown>
</div>

{{-- filter by category --}}
<div class="relative">
    @if (isset($categories) && count($categories) > 0)
        <x-mary-badge value="{{ count($categories) }}" class="badge-primary absolute -right-2 z-40 -top-2" />
    @endif

    <x-mary-dropdown label="Category" class=" relative" no-x-anchor>

        {{-- clear category  filter --}}
        <x-mary-menu-item wire:click.live="clearCategoryFilter()" icon="o-x-mark" title="Clear filter" />
        <x-mary-menu-separator />
        <div class="max-h-96 overflow-auto scroll-m-1">
            @foreach ($this->getCategories as $cat)
                <x-mary-menu-item wire:key="cat-{{ $cat->id }}" @click.stop="">
                    <x-mary-checkbox :value="$cat->id" wire:model.live="categories" :label="$cat->name" />
                </x-mary-menu-item>
            @endforeach
        </div>

    </x-mary-dropdown>
</div>
