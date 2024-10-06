 <x-slot:sidebar drawer="main-drawer" collapsible class="bg-white md:bg-transparent ">

     {{-- User --}}
     @if ($user = auth()->user())
         <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
             <x-slot:actions>
                 <x-mary-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate
                     link="/logout" />
             </x-slot:actions>
         </x-mary-list-item>

         <x-mary-menu-separator />
     @endif

     {{-- Activates the menu item when a route matches the `link` property --}}
     <x-mary-menu activate-by-route>
         <x-mary-menu-item title="Dashboard" icon="o-home" link="{{ route('dashboard') }}" wire:navigate />
         <x-mary-menu-item title="Orders" icon="o-swatch" link="#" wire:navigate />
         <x-mary-menu-sub title="Wirehouse" icon="o-home-modern" wire:navigate>
             <x-mary-menu-item @click.stop title="Categories" icon="o-paper-clip" link="##" />
             <x-mary-menu-item @click.stop title="Brands" icon="o-rocket-launch" link="####" />
             <x-mary-menu-item @click.stop title="Products" icon="o-tag" link="/products" activate-by-route />
         </x-mary-menu-sub>
     </x-mary-menu>
 </x-slot:sidebar>
