<x-layouts.admin title="Dashboard Pusat">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Dashboard'],
        ]" />
    </x-slot>

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Selamat Datang, {{ auth()->user()->nama_user }}! 👋</h1>
        <p class="text-slate-500 mt-1">Berikut adalah ringkasan sistem secara keseluruhan hari ini.</p>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ $isAdmin ? '4' : '1' }} gap-6 mb-8">
        
        @if($isAdmin)
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center justify-between group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Pengguna</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ number_format($totalUsers) }}</h3>
            </div>
            <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
        </div>

        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center justify-between group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Menu</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ number_format($totalMenus) }}</h3>
            </div>
            <div class="w-14 h-14 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
            </div>
        </div>
        @endif

        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center justify-between group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">{{ $isAdmin ? 'Aktivitas Sistem' : 'Total Aktivitas Saya' }}</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ number_format($totalActivities) }}</h3>
            </div>
            <div class="w-14 h-14 rounded-full bg-purple-50 text-purple-500 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
        </div>

        @if($isAdmin)
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center justify-between group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Error Terdeteksi</p>
                <h3 class="text-3xl font-bold text-slate-800">{{ number_format($totalErrors) }}</h3>
            </div>
            <div class="w-14 h-14 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </div>
        @endif

    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-{{ $isAdmin ? '2' : '1' }} gap-8">
        
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col h-full">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $isAdmin ? 'Aktivitas Terbaru' : 'Aktivitas Anda' }}
                </h3>
                @if($isAdmin || \App\Models\MenuUser::where('id_user', auth()->user()->id_user)->whereHas('menu', function($q) { $q->where('menu_link', '/activity-log'); })->exists())
                    <a href="{{ route('activity-log.index') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700">Lihat Semua &rarr;</a>
                @endif
            </div>
            <div class="p-0 flex-1">
                @if(count($recentActivities) > 0)
                    <ul class="divide-y divide-slate-100">
                        @foreach($recentActivities as $activity)
                        <li class="p-4 hover:bg-slate-50 transition-colors flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center shrink-0 uppercase font-bold text-xs">
                                {{ $activity->user ? substr($activity->user->nama_user, 0, 2) : '?' }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-800 line-clamp-1">
                                    {{ $activity->diskripsi }}
                                </p>
                                <p class="text-xs text-slate-500 mt-1">
                                    Oleh: <span class="font-medium">{{ $activity->user->nama_user ?? 'Unknown' }}</span>
                                </p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="text-xs font-medium text-slate-400">
                                    {{ $activity->create_date ? $activity->create_date->diffForHumans() : '-' }}
                                </p>
                                <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600">
                                    {{ $activity->status }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div class="p-8 text-center text-slate-500">
                        <p>Belum ada catatan aktivitas.</p>
                    </div>
                @endif
            </div>
        </div>

        @if($isAdmin)
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col h-full">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-rose-50/30">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Peringatan Sistem (Error)
                </h3>
                <a href="{{ route('error-log.index') }}" class="text-xs font-semibold text-rose-600 hover:text-rose-700">Periksa &rarr;</a>
            </div>
            <div class="p-0 flex-1">
                @if(count($recentErrors) > 0)
                    <ul class="divide-y divide-slate-100">
                        @foreach($recentErrors as $error)
                        <li class="p-4 hover:bg-rose-50/50 transition-colors flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-rose-700 line-clamp-1" title="{{ $error->error_message }}">
                                    {{ $error->error_message }}
                                </p>
                                <p class="text-xs text-slate-500 mt-1 font-mono">
                                    {{ $error->controller ?: 'Unknown' }}::{{ $error->function ?: 'unknown' }}()
                                </p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="text-xs font-medium text-slate-400">
                                    {{ $error->create_date ? $error->create_date->diffForHumans() : '-' }}
                                </p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div class="p-8 text-center text-slate-500">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-emerald-50 text-emerald-500 mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <p class="font-medium text-emerald-600">Sistem Sehat</p>
                        <p class="text-sm mt-1">Tidak ada error terekam akhir-akhir ini.</p>
                    </div>
                @endif
            </div>
        </div>
        @endif

    </div>

</x-layouts.admin>
