<x-layouts.admin title="Detail Error">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Log Error', 'url' => route('error-log.index')],
            ['label' => 'Detail Error'],
        ]" />
    </x-slot>

    <div class="mb-6">
        <x-page-header
            title="Detail Error #{{ $error->error_id }}"
            subtitle="Informasi lengkap mengenai *exception* yang terjadi"
            back-url="{{ route('error-log.index') }}"
            class="mb-0" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-5 border-b border-slate-100 bg-rose-50/50 flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-rose-100 flex items-center justify-center shrink-0">
                        <svg class="h-5 w-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800">Pesan Error Utama</h3>
                        <p class="text-xs text-slate-500 font-mono mt-0.5">Kode: {{ $error->status }}</p>
                    </div>
                </div>
                <div class="p-5 bg-slate-900 text-rose-300 font-mono text-sm leading-relaxed overflow-x-auto whitespace-pre-wrap">
                    {{ $error->error_message }}
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center gap-2">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                    </svg>
                    <h3 class="font-bold text-slate-800">Parameter Request</h3>
                </div>
                <div class="p-5 bg-slate-50 font-mono text-sm overflow-x-auto">
                    @if(isset($error->param_array) && is_array($error->param_array) && count($error->param_array) > 0)
                        <pre class="text-slate-700">{{ json_encode($error->param_array, JSON_PRETTY_PRINT) }}</pre>
                    @elseif($error->param && $error->param !== '[]')
                        <pre class="text-slate-700">{{ $error->param }}</pre>
                    @else
                        <span class="text-slate-400 italic">Tidak ada parameter request yang dikirimkan.</span>
                    @endif
                </div>
            </div>
        </div>

        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                <h3 class="font-bold text-slate-800 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <svg class="h-5 w-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informasi Kejadian
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Waktu Error</p>
                        <p class="text-sm font-medium text-slate-800">{{ $error->create_date ? $error->create_date->format('d M Y H:i:s') : '-' }}</p>
                    </div>
                    
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Modul / Path</p>
                        <p class="text-sm font-medium text-slate-800 font-mono bg-slate-50 p-1.5 rounded">{{ $error->modules ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Controller</p>
                        <p class="text-sm font-medium text-slate-800 break-words">{{ $error->controller ?: '-' }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Function</p>
                            <p class="text-sm font-medium text-slate-800">{{ $error->function ?: '-' }}()</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Error Line</p>
                            <p class="text-sm font-medium text-rose-600 font-bold">Line {{ $error->error_line ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                <h3 class="font-bold text-slate-800 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <svg class="h-5 w-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Pelaku / Pengguna
                </h3>
                
                @if($error->user)
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold uppercase shrink-0">
                            {{ substr($error->user->nama_user, 0, 2) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">{{ $error->user->nama_user }}</p>
                            <p class="text-xs text-slate-500">{{ $error->user->id_user }} &middot; {{ $error->user->jenisUser->jenis_user ?? '?' }}</p>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold uppercase shrink-0">
                            SY
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">SYSTEM / GUEST</p>
                            <p class="text-xs text-slate-500">Error terjadi di luar sesi pengguna aktif</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-layouts.admin>
