@if(auth()->check())
    <x-layouts.admin title="404 - Halaman Tidak Ditemukan">
        <div class="flex items-center justify-center min-h-[70vh]">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-slate-100 mb-6 border border-slate-200">
                    <svg class="h-10 w-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-slate-900 mb-2">404</h1>
                <h2 class="text-lg font-semibold text-slate-700 mb-4">Halaman Tidak Ditemukan</h2>
                <p class="text-slate-500 mb-8 max-w-sm mx-auto">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan dari sistem.</p>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-5 py-2.5 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition-colors shadow-sm">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </x-layouts.admin>
@else
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>404 - Halaman Tidak Ditemukan</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        <div class="min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full text-center">
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-white shadow-sm border border-slate-200 mb-6">
                    <svg class="h-10 w-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 mb-2">404</h1>
                <h2 class="text-xl font-semibold text-slate-700 mb-4">Halaman Tidak Ditemukan</h2>
                <p class="text-slate-500 mb-8 leading-relaxed">Maaf, halaman yang Anda tuju tidak tersedia atau Anda salah memasukkan URL sistem.</p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ url('/') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors shadow-sm">
                        Halaman Utama
                    </a>
                    <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 bg-white text-slate-700 border border-slate-300 text-sm font-medium rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                        Login ke Sistem
                    </a>
                </div>
                
                <div class="mt-16 text-xs text-slate-400 font-medium">
                    &copy; {{ date('Y') }} {{ config('app.name', 'User Management System') }}. All rights reserved.
                </div>
            </div>
        </div>
    </body>
    </html>
@endif
