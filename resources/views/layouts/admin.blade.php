<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title . ' — ' : '' }}{{ config('app.name', 'User Management') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-100 font-sans antialiased">

    <x-sidebar />

    <x-topbar>
        @isset($breadcrumb)
            <x-slot name="breadcrumb">{{ $breadcrumb }}</x-slot>
        @endisset
    </x-topbar>

    <div class="pt-16 transition-all duration-300"
        x-data="{ get ml() { return Alpine.store('sidebar') && Alpine.store('sidebar').isOpen ? 'md:ml-64' : 'md:ml-20'; } }"
        :class="ml">

        <main class="p-4 md:p-6 min-h-[calc(100vh-4rem-68px)] block w-full">
            {{ $slot }}
        </main>
        
        <x-footer />

    </div>

</body>
</html>
