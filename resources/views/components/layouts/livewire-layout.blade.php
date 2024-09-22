<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    @livewireStyles()
</head>

<body class="font-sans antialiased min-h-screen dark:bg-black bg-gray-100/60 dark:text-white/50">

    {{-- NAVBAR --}}
    <div class="w-full bg-white">
        <div class="container mx-auto">
            <x-mary-nav class="border-b-0" sticky full-width no-separator>
                <x-slot:brand>
                    {{-- Drawer toggle for "main-drawer" --}}
                    <label for="main-drawer" class="lg:hidden mr-3">
                        <x-mary-icon name="o-bars-3" class="cursor-pointer" />
                    </label>

                    {{-- Brand --}}
                    <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-x-2">
                        <img class="h-8 w-8" src="{{ asset('images/orange.png') }}" alt="brand logo">
                        <span
                            class="bg-gradient-to-r from-orange-500  to-orange-300 inline-block font-bold text-2xl text-transparent bg-clip-text">Orange.</span>
                    </a>
                </x-slot:brand>

                {{-- Right side actions --}}
                <x-slot:actions>
                    <livewire:cart-items></livewire:cart-items>

                    @auth
                        <x-mary-dropdown no-x-anchor label="Cart" icon="o-user-circle" class="btn-ghost space-y-1 btn-sm">
                            <x-mary-menu-item icon="o-heart" title="Wishlist" wire:navigate />
                            <x-mary-menu-item icon="o-shopping-bag" title="My orders" wire:navigate />

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-white mt-1  gap-2 w-full bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <x-mary-icon name="o-power"></x-mary-icon>
                                    <span> logout</span>
                                </button>
                            </form>

                        </x-mary-dropdown>
                    @else
                        <x-mary-button label="Login" icon="o-user-circle" link="{{ route('login') }}"
                            class="btn-ghost btn-sm" responsive />
                    @endauth
                </x-slot:actions>
            </x-mary-nav>
        </div>
    </div>

    {{-- MAIN --}}
    <div class="container mx-auto">
        <x-mary-main with-nav full-width>
            <x-slot:content>
                {{ $slot }}
            </x-slot:content>
        </x-mary-main>
    </div>

    {{-- TOAST --}}
    <x-mary-toast />
    </div>
    @livewireScripts()
    </div>
</body>

</html>
