<x-layouts.admin title="Daftar Log Error">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Log Error'],
        ]" />
    </x-slot>

    <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 gap-4">
        <x-page-header
            title="Log Error Sistem"
            subtitle="Pantau *exception* dan kegagalan yang terjadi di balik layar"
            class="mb-0" />
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 mb-6" x-data="{ expanded: false }">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between cursor-pointer hover:bg-slate-50 transition-colors" @click="expanded = !expanded">
            <h3 class="font-semibold text-slate-700 flex items-center gap-2">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Pencarian & Filter
            </h3>
            <svg class="w-5 h-5 text-slate-400 transition-transform duration-200" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
        
        <div x-show="expanded" x-collapse x-cloak>
            <form method="GET" action="{{ route('error-log.index') }}" class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <div class="md:col-span-1">
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Pencarian Kata Kunci</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari error message, controller..." 
                        class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-colors">
                </div>
                
                <div class="md:col-span-1 grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Dari Tanggal</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" 
                            class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Sampai Tanggal</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" 
                            class="w-full px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-colors">
                    </div>
                </div>

                <div class="md:col-span-1 flex items-end gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-rose-600 text-white font-medium text-sm rounded-lg hover:bg-rose-500 transition-colors">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('error-log.index') }}" class="px-4 py-2 bg-white text-slate-600 border border-slate-300 font-medium text-sm rounded-lg hover:bg-slate-50 transition-colors">
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
                        <th class="py-3 px-5 text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap w-40">Waktu</th>
                        <th class="py-3 px-5 text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap w-48">Lokasi (Modul)</th>
                        <th class="py-3 px-5 text-xs font-semibold text-slate-600 uppercase tracking-wider min-w-[300px]">Pesan Error</th>
                        <th class="py-3 px-5 text-xs font-semibold text-slate-600 uppercase tracking-wider whitespace-nowrap w-24 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($errors as $err)
                        <tr class="hover:bg-rose-50/30 transition-colors group">
                            <td class="py-3 px-5 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-800">{{ $err->create_date ? $err->create_date->format('d M Y') : '-' }}</div>
                                <div class="text-xs text-slate-500">{{ $err->create_time ?? '-' }}</div>
                            </td>
                            <td class="py-3 px-5">
                                <p class="text-sm font-semibold text-slate-800 line-clamp-1" title="{{ $err->controller }}">{{ $err->controller ?: 'Unknown' }}</p>
                                <p class="text-xs text-slate-500 font-mono mt-0.5">L.{{ $err->error_line ?? '?' }} &middot; {{ $err->function ?: 'unknown_func' }}</p>
                            </td>
                            <td class="py-3 px-5">
                                <div class="flex items-start gap-2">
                                    <span class="mt-0.5 px-1.5 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-700 whitespace-nowrap">
                                        {{ $err->status }}
                                    </span>
                                    <p class="text-sm text-slate-700 font-mono text-xs line-clamp-2" title="{{ $err->error_message }}">
                                        {{ $err->error_message }}
                                    </p>
                                </div>
                            </td>
                            <td class="py-3 px-5 text-center whitespace-nowrap">
                                <a href="{{ route('error-log.show', $err->error_id) }}" 
                                   class="inline-flex items-center justify-center p-2 bg-slate-50 hover:bg-rose-50 text-slate-600 hover:text-rose-600 border border-slate-200 hover:border-rose-200 rounded-lg transition-colors" title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="h-16 w-16 bg-emerald-50 rounded-full flex items-center justify-center mb-3">
                                        <svg class="h-8 w-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-medium text-slate-900 mb-1">Sistem Sehat</h3>
                                    <p class="text-sm text-slate-500 max-w-sm mx-auto">
                                        Tidak ada catatan error ditemukan. Semua sistem berjalan dengan normal dan stabil.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($errors->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $errors->links() }}
            </div>
        @endif
    </div>

</x-layouts.admin>
