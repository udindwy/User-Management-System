<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login — {{ config('app.name', 'User Management') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }

        .bg-dots {
            background-image: radial-gradient(circle, rgba(255,255,255,0.06) 1px, transparent 1px);
            background-size: 28px 28px;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white min-h-screen flex">

    {{-- ===== LEFT PANEL ===== --}}
    <div class="hidden lg:flex lg:w-5/12 xl:w-1/2 bg-slate-900 relative overflow-hidden flex-col">

        <div class="absolute inset-0 bg-dots opacity-100"></div>
        <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-slate-600 to-transparent"></div>

        <div class="relative z-10 flex flex-col h-full px-12 py-12 xl:px-16">

            <div class="flex items-center space-x-2.5">
                <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <span class="text-white font-semibold text-sm tracking-wide">{{ config('app.name', 'User Management') }}</span>
            </div>

            <div class="flex-1 flex flex-col justify-center max-w-sm">

                <p class="text-slate-500 text-xs font-semibold uppercase tracking-widest mb-4">Core System</p>

                <h1 class="text-3xl xl:text-4xl font-bold text-white leading-snug mb-5">
                    Kelola akses.<br>
                    Pantau aktivitas.<br>
                    <span class="text-slate-400 font-normal">Satu platform.</span>
                </h1>

                <p class="text-slate-500 text-sm leading-relaxed mb-10">
                    Sistem manajemen pengguna dan hak akses yang dirancang sebagai fondasi pengembangan sistem perusahaan.
                </p>

                <div class="space-y-px">
                    @foreach([
                        ['Manajemen pengguna & jenis user', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['Hak akses menu berbasis user', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                        ['Log aktivitas & error aplikasi', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ] as $item)
                    <div class="flex items-center space-x-3 py-3 border-b border-slate-800">
                        <svg class="w-4 h-4 text-slate-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $item[1] }}" />
                        </svg>
                        <span class="text-slate-400 text-sm">{{ $item[0] }}</span>
                    </div>
                    @endforeach
                </div>

            </div>

            <p class="text-slate-700 text-xs">&copy; {{ date('Y') }} {{ config('app.name') }}.</p>

        </div>
    </div>

    {{-- ===== RIGHT PANEL ===== --}}
    <div class="w-full lg:w-7/12 xl:w-1/2 flex items-center justify-center bg-white px-6 sm:px-10 py-12">

        <div class="w-full max-w-sm">

            <div class="lg:hidden flex items-center space-x-2.5 mb-10">
                <div class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <span class="text-slate-900 font-semibold text-sm">{{ config('app.name') }}</span>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-bold text-slate-900">Masuk ke akun Anda</h2>
                <p class="text-slate-500 text-sm mt-1">Gunakan username dan password yang telah diberikan.</p>
            </div>

            @if(session('status'))
                <div class="mb-5 p-3 bg-slate-50 border border-slate-200 rounded-lg">
                    <p class="text-sm text-slate-600">{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="space-y-4">

                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Username
                        </label>
                        <input
                            id="username"
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="username"
                            class="w-full px-3.5 py-2.5 bg-white border text-slate-900 placeholder-slate-400 text-sm rounded-lg
                                focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 transition-colors
                                {{ $errors->has('username') ? 'border-red-400 bg-red-50' : 'border-slate-300 hover:border-slate-400' }}"
                        >
                        @error('username')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ showPass: false }">
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Password
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                :type="showPass ? 'text' : 'password'"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full px-3.5 py-2.5 pr-10 bg-white border text-slate-900 placeholder-slate-400 text-sm rounded-lg
                                    focus:outline-none focus:ring-2 focus:ring-slate-900/10 focus:border-slate-400 transition-colors
                                    {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-slate-300 hover:border-slate-400' }}"
                            >
                            <button type="button" @click="showPass = !showPass"
                                class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPass" class="w-4 h-4" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-0.5">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" name="remember" id="remember"
                                class="w-3.5 h-3.5 rounded border-slate-300 text-slate-900 focus:ring-slate-900/20">
                            <span class="text-sm text-slate-500">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 px-4 bg-slate-900 hover:bg-slate-700 text-white font-semibold rounded-lg
                            text-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-slate-900/30 mt-1">
                        Masuk
                    </button>

                </div>
            </form>

            <p class="text-center text-xs text-slate-400 mt-10">&copy; {{ date('Y') }} {{ config('app.name') }}</p>

        </div>
    </div>

</body>
</html>
