<x-layouts.admin title="Dashboard">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Dashboard'],
        ]" />
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">

        <div class="bg-white rounded-xl border border-slate-200 p-5 flex items-center space-x-4 shadow-sm">
            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <div class="text-2xl font-bold text-slate-800">{{ \App\Models\User::active()->count() }}</div>
                <div class="text-sm text-slate-500 font-medium">Total User Aktif</div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-5 flex items-center space-x-4 shadow-sm">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </div>
            <div>
                <div class="text-2xl font-bold text-slate-800">{{ \App\Models\Menu::active()->count() }}</div>
                <div class="text-sm text-slate-500 font-medium">Total Menu</div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-5 flex items-center space-x-4 shadow-sm">
            <div class="w-12 h-12 bg-violet-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
            <div>
                <div class="text-2xl font-bold text-slate-800">{{ \App\Models\JenisUser::count() }}</div>
                <div class="text-sm text-slate-500 font-medium">Jenis User</div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-5 flex items-center space-x-4 shadow-sm">
            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <div class="text-2xl font-bold text-slate-800">{{ \App\Models\LErrorApplication::active()->count() }}</div>
                <div class="text-sm text-slate-500 font-medium">Log Error</div>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
        <h2 class="text-base font-semibold text-slate-800 mb-1">Selamat Datang</h2>
        <p class="text-sm text-slate-500">
            Anda login sebagai
            <span class="font-semibold text-slate-700">
                {{ auth()->user()->nama_user ?? auth()->user()->username }}
            </span>.
        </p>
    </div>

</x-layouts.admin>
