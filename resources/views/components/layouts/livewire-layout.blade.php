<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <tallstackui:script />
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    @livewireStyles()
</head>

<body class="font-poppins antialiased min-h-screen dark:bg-black bg-gray-100/60 dark:text-white/50">
    {{-- NAVBAR --}}
    <div class="w-full bg-white">
        <div class="mx-auto">
            <x-mary-nav class="border-b-0 p-4 md:px-48" sticky spinner full-width no-separator>
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
                    <livewire:cart-items></livewire:cart-items>
                    @auth
                        <x-mary-dropdown no-x-anchor :label="Auth::user()->name" icon="o-user-circle"
                            class="btn-ghost space-y-1 btn-sm">

                            {{-- wishlist --}}
                            <x-mary-menu-item icon="o-heart" :link="route('wishlist-items')" title="Wishlist" wire:navigate />

                            {{-- Orders  --}}
                            <x-mary-menu-item :link="route('orders-list')" icon="o-shopping-bag" title="My orders" wire:navigate />

                            {{-- Logout --}}
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
