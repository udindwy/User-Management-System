<x-layouts.admin title="User Activity Log">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Activity Log'],
        ]" />
    </x-slot>

    <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 gap-4">
        <x-page-header
            title="User Activity Log"
            subtitle="Pantau seluruh aktivitas pengguna di dalam sistem"
            class="mb-0" />
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 mb-6" x-data="{ expanded: false }">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition-colors" @click="expanded = !expanded">
            <h3 class="font-semibold text-slate-700 flex items-center gap-2">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Pencarian & Filter
            </h3>
            <svg class="w-5 h-5 text-slate-400 transition-transform duration-200" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
        
        <div x-show="expanded" x-collapse x-cloak>
            <form method="GET" action="{{ route('activity-log.index') }}" class="p-5 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                
                <div class="lg:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Pencarian Kata Kunci</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, deskripsi..." 
                        class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors">
                </div>
                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">User</label>
                    <select name="user_id" class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors">
                        <option value="">-- Semua User --</option>
                        @foreach($users as $usr)
                            <option value="{{ $usr->id_user }}" {{ request('user_id') == $usr->id_user ? 'selected' : '' }}>
                                {{ $usr->nama_user }} ({{ $usr->username }})
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Aksi</label>
                    <select name="action" class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors">
                        <option value="">-- Semua Aksi --</option>
                        @foreach($actions as $act)
                            <option value="{{ $act }}" {{ request('action') == $act ? 'selected' : '' }}>{{ $act }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-2 lg:col-span-1">
                    <button type="submit" class="w-full px-4 py-2 bg-primary-600 text-white font-medium text-sm rounded-lg hover:bg-primary-500 transition-colors">
                        Terapkan
                    </button>
                    <a href="{{ route('activity-log.index') }}" class="px-4 py-2 bg-white text-slate-600 border border-slate-300 font-medium text-sm rounded-lg hover:bg-slate-50 transition-colors">
                        Reset
                    </a>
                </div>

            </form>
        </div>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-3 px-5 text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap w-48">Waktu Kejadian</th>
                        <th class="py-3 px-5 text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap w-64">User / Pelaku</th>
                        <th class="py-3 px-5 text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap w-40">Aksi</th>
                        <th class="py-3 px-5 text-xs font-semibold text-slate-600 uppercase tracking-wider min-w-[200px]">Deskripsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($activities as $activity)
                        <tr class="hover:bg-slate-50/70 transition-colors group">
                            <td class="py-3 px-5 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-800">{{ $activity->create_date ? $activity->create_date->format('d M Y') : '-' }}</div>
                                <div class="text-xs text-slate-500">{{ $activity->create_date ? $activity->create_date->format('H:i:s') : '-' }}</div>
                            </td>
                            <td class="py-3 px-5">
                                @if($activity->user)
                                    <div class="flex items-center space-x-3">
                                        <div class="h-8 w-8 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-xs uppercase shrink-0">
                                            {{ substr($activity->user->nama_user, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-800 line-clamp-1">{{ $activity->user->nama_user }}</p>
                                            <p class="text-xs text-slate-500">{{ $activity->user->id_user }}</p>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-sm text-slate-400 italic">User Tidak Diketahui</span>
                                @endif
                            </td>
                            <td class="py-3 px-5 whitespace-nowrap">
                                @php
                                    $statusColor = match($activity->status) {
                                        'Login' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'Logout' => 'bg-slate-100 text-slate-700 border-slate-200',
                                        'Tambah Data' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'Edit Data' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'Hapus Data' => 'bg-red-50 text-red-700 border-red-200',
                                        'Akses Menu' => 'bg-purple-50 text-purple-700 border-purple-200',
                                        default => 'bg-slate-50 text-slate-700 border-slate-200'
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border {{ $statusColor }}">
                                    {{ $activity->status }}
                                </span>
                            </td>
                            <td class="py-3 px-5">
                                <p class="text-sm text-slate-700">{{ $activity->diskripsi }}</p>
                                @if($activity->menu)
                                    <p class="text-xs text-slate-500 mt-0.5 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                        </svg>
                                        {{ $activity->menu->menu_name }}
                                    </p>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="h-16 w-16 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                                        <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-medium text-slate-900 mb-1">Tidak ada aktivitas</h3>
                                    <p class="text-sm text-slate-500 max-w-sm mx-auto">
                                        Sistem belum mencatat aktivitas apa pun atau tidak ada data yang cocok dengan pencarian Anda.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($activities->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $activities->links() }}
            </div>
        @endif
    </div>

</x-layouts.admin>
