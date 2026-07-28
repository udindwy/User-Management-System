@php
    $user = auth()->user();
    $userName = $user->nama_user ?? $user->username ?? 'User';
    $userInitial = strtoupper(substr($userName, 0, 1));
    $userRole = $user->jenisUser?->jenis_user ?? 'User';
    $activeFoto = $user->fotos()->active()->latest('create_date')->first();
    // Notifikasi hanya mengambil log untuk Admin saja
    $recentActivities = collect();
    if ($user->id_jenis_user === 'ADM') {
        $recentActivities = \App\Models\UserActivity::with('user')
            ->active()
            ->latest('create_date')
            ->take(5)
            ->get();
    }

    // Cek apakah user punya hak akses ke menu Activity Log
    $hasActivityLogAccess = \App\Models\MenuUser::where('id_user', $user->id_user)
        ->whereHas('menu', function($q) {
            $q->where('menu_link', '/activity-log');
        })->exists();
@endphp

<header x-data="{ userDropdown: false, notifications: false, hasNewNotif: {{ $recentActivities->count() > 0 ? 'true' : 'false' }} }"
    class="fixed top-0 right-0 h-16 bg-white border-b border-slate-200 z-20 transition-all duration-300"
    :class="$store.sidebar && $store.sidebar.isOpen ? 'left-0 md:left-64' : 'left-0 md:left-20'">

    <div class="h-full px-4 md:px-6 flex items-center justify-between">

        <div class="flex items-center">
            <div class="hidden md:block">
                {{ $breadcrumb ?? '' }}
            </div>
        </div>

        <div class="flex items-center space-x-1">

            @if($user->id_jenis_user === 'ADM')
            <div class="relative">
                <button @click="notifications = !notifications; userDropdown = false; hasNewNotif = false"
                    class="relative p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <template x-if="hasNewNotif">
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    </template>
                </button>

                <div x-show="notifications" @click.away="notifications = false" x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-slate-200 py-2 origin-top-right">

                    <div class="px-4 py-2.5 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="font-semibold text-sm text-slate-900">Aktivitas Terbaru</h3>
                        @if($recentActivities->count() > 0)
                            <span class="text-xs bg-primary-100 text-primary-700 font-medium px-2 py-0.5 rounded-full">
                                {{ $recentActivities->count() }} baru
                            </span>
                        @endif
                    </div>

                    <div class="max-h-80 overflow-y-auto">
                        @forelse($recentActivities as $activity)
                            <a href="{{ route('activity-log.index') }}"
                                class="flex items-start space-x-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                                <div class="w-7 h-7 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="text-xs font-semibold text-primary-700">
                                        {{ strtoupper(substr($activity->user?->nama_user ?? $activity->user?->username ?? '?', 0, 1)) }}
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-slate-800 font-medium truncate">
                                        {{ $activity->user?->nama_user ?? $activity->user?->username ?? 'Unknown' }}
                                    </p>
                                    <p class="text-xs text-slate-500 mt-0.5 truncate">{{ $activity->diskripsi }}</p>
                                    @if($activity->create_date)
                                        <p class="text-xs text-slate-400 mt-0.5">
                                            {{ \Carbon\Carbon::parse($activity->create_date)->diffForHumans() }}
                                        </p>
                                    @endif
                                </div>
                            </a>
                        @empty
                            <div class="px-4 py-6 text-center">
                                <svg class="w-8 h-8 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <p class="text-sm text-slate-500">Tidak ada aktivitas terbaru</p>
                            </div>
                        @endforelse
                    </div>

                    @if($hasActivityLogAccess)
                        <div class="px-4 py-2 border-t border-slate-100">
                            <a href="{{ route('activity-log.index') }}"
                                class="text-xs text-primary-600 hover:text-primary-700 font-semibold">
                                Lihat semua aktivitas →
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <div class="relative">
                <button @click="userDropdown = !userDropdown; notifications = false"
                    class="flex items-center space-x-2 px-2 py-1.5 hover:bg-slate-100 rounded-lg transition-colors">
                    <div class="w-8 h-8 bg-gradient-primary rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden border-2 border-white shadow-sm">
                        @if($activeFoto && $activeFoto->foto)
                            <img src="{{ Storage::url($activeFoto->foto) }}" alt="Avatar" class="w-full h-full object-cover">
                        @else
                            <span class="text-white text-sm font-semibold">{{ $userInitial }}</span>
                        @endif
                    </div>
                    <div class="hidden md:block text-left">
                        <div class="text-sm font-semibold text-slate-800 leading-tight">{{ $userName }}</div>
                        <div class="text-xs text-slate-500 leading-tight">{{ $userRole }}</div>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 hidden md:block transition-transform duration-200"
                        :class="userDropdown ? 'rotate-180' : ''"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="userDropdown" @click.away="userDropdown = false" x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-slate-200 py-2 origin-top-right">

                    <div class="py-1">
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center space-x-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Profil Saya</span>
                        </a>
                    </div>

                    <div class="border-t border-slate-100 pt-1">
                        <button type="button" @click="$dispatch('open-logout-modal')"
                            class="flex items-center space-x-2.5 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</header>


<div x-data="{ logoutModalOpen: false }" @open-logout-modal.window="logoutModalOpen = true" x-cloak x-show="logoutModalOpen"
    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 backdrop-blur-sm"
    style="display: none;">

    
    <div @click.away="logoutModalOpen = false" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95"
        class="relative w-full max-w-sm rounded-2xl bg-white p-8 shadow-xl text-center transform transition-all">

        
        <div class="mx-auto w-16 h-16 rounded-full bg-red-100 flex items-center justify-center">
            <svg class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <h2 class="mt-6 text-2xl font-bold text-gray-900">Konfirmasi Logout</h2>
        <p class="mt-2 text-gray-600">Apakah Anda yakin ingin keluar dari sesi ini?</p>

        
        <div class="mt-8 flex justify-center gap-4">
            
            <button type="button" @click="logoutModalOpen = false"
                class="rounded-full border border-gray-300 bg-white px-8 py-3 font-semibold text-gray-800 transition hover:bg-gray-50">
                Batal
            </button>

            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="rounded-full bg-red-500 px-8 py-3 font-semibold text-white shadow-md transition hover:bg-red-600">
                    Ya, Logout
                </button>
            </form>
        </div>
    </div>
</div>
