<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tiny.cloud/1/YOUR-KEY-HERE/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    {{-- Cropper.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-poppins antialiased">
    <div class="container mx-auto">

        @include('layouts.includes.navbare')

        {{-- The main content with `full-width` --}}
        <x-mary-main with-nav full-width class="bg-white">

            {{-- drawer --}}
            <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">

                {{-- side bare here --}}
                @include('layouts.includes.sidebare')

                {{-- The `$slot` goes here --}}
                <x-slot:content>
                    {{ $slot }}
                </x-slot:content>
        </x-mary-main>
    </div>

    {{--  TOAST area --}}
    <x-mary-toast />
    @stack('modals')

    @livewireScripts
</body>

</html>
