@php
    $recentActivities = \App\Models\UserActivity::with('user')
        ->active()
        ->latest('create_date')
        ->take(5)
        ->get();

    $user = auth()->user();
    $userName = $user->nama_user ?? $user->username ?? 'User';
    $userInitial = strtoupper(substr($userName, 0, 1));
    $userRole = $user->jenisUser?->jenis_user ?? 'User';
@endphp

<header x-data="{ userDropdown: false, notifications: false }"
    class="fixed top-0 right-0 h-16 bg-white border-b border-slate-200 z-20 transition-all duration-300"
    :class="$store.sidebar && $store.sidebar.isOpen ? 'left-0 md:left-64' : 'left-0 md:left-20'">

    <div class="h-full px-4 md:px-6 flex items-center justify-between">

        <div class="flex items-center">
            <div class="hidden md:block">
                {{ $breadcrumb ?? '' }}
            </div>
        </div>

        <div class="flex items-center space-x-1">

            <div class="relative">
                <button @click="notifications = !notifications; userDropdown = false"
                    class="relative p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    @if($recentActivities->count() > 0)
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                    @endif
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

                    <div class="px-4 py-2 border-t border-slate-100">
                        <a href="{{ route('activity-log.index') }}"
                            class="text-xs text-primary-600 hover:text-primary-700 font-semibold">
                            Lihat semua aktivitas →
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative">
                <button @click="userDropdown = !userDropdown; notifications = false"
                    class="flex items-center space-x-2 px-2 py-1.5 hover:bg-slate-100 rounded-lg transition-colors">
                    <div class="w-8 h-8 bg-gradient-primary rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-sm font-semibold">{{ $userInitial }}</span>
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

                        <a href="{{ route('users.index') }}"
                            class="flex items-center space-x-2.5 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Pengaturan</span>
                        </a>
                    </div>

                    <div class="border-t border-slate-100 pt-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center space-x-2.5 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</header>
