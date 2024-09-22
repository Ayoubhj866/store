<nav x-data="{ open: tru }" class="bg-white border-b border-gray-100">
    {{-- NAVBAR --}}
    <div class="w-full bg-white">
        <div class="container mx-auto">
            <x-mary-nav class="border-none  gap-x-4" sticky full-width no-separator>

                <x-slot:brand>
                    {{-- Drawer toggle for "main-drawer" --}}
                    <label for="main-drawer" class="lg:hidden mr-3">
                        <x-mary-icon name="o-bars-3" class="cursor-pointer" />
                    </label>

                    {{-- Brand --}}
                    <div class="flex items-center gap-x-2">
                        <img class="h-8 w-8" src="{{ asset('images/orange.png') }}" alt="brand logo">
                        <span
                            class="bg-gradient-to-r from-orange-500  to-orange-300 inline-block font-bold text-2xl text-transparent bg-clip-text">Orange.</span>
                    </div>
                </x-slot:brand>

                {{-- User nav-items --}}
                <x-slot:actions>
                    <div class="flex items-center">

                        <x-mary-menu activate-by-route class="flex items-center">
                            <div class="flex items-center gap-4">
                                <x-mary-menu-item wire:navigate title="Dashboard" icon="o-home"
                                    link="{{ route('dashboard') }}" />
                                <x-mary-menu-item wire:navigate title="Home" icon="o-home" link="###" />
                                <x-mary-menu-item wire:navigate title="Products" icon="o-building-storefront"
                                    link="{{ route('products.management') }}" />
                            </div>
                        </x-mary-menu>
                    </div>
                    @auth
                        <x-mary-dropdown label="Cart" icon="o-user-circle" class="btn-ghost space-y-1 btn-sm">
                            <x-mary-menu-item icon="o-heart" title="Wishlist" />
                            <x-mary-menu-item icon="o-shopping-bag" title="My orders" />

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


</nav>
