<x-mary-nav sticky full-width>

    <x-slot:brand>
        {{-- Drawer toggle for "main-drawer" --}}
        <label for="main-drawer" class="lg:hidden mr-3">
            <x-mary-icon name="o-bars-3" class="cursor-pointer" />
        </label>

        {{-- Brand --}}
        <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-x-2">
            <img class="h-8 w-8" src="{{ asset('images/logo.svg') }}" alt="brand logo">
            <span
                class="bg-gradient-to-r from-purple-500  to-purple-300 inline-block font-bold text-2xl text-transparent bg-clip-text">EzyMarket.</span>
        </a>
    </x-slot:brand>

    {{-- Right side actions --}}
    <x-slot:actions>
        <x-mary-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />
        <x-mary-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />
    </x-slot:actions>
</x-mary-nav>
