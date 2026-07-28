<x-layouts.admin title="Hak Akses Menu">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Hak Akses Menu'],
        ]" />
    </x-slot>

    <x-page-header title="Hak Akses Menu" subtitle="Kelola pengaturan otorisasi menu per pengguna">
    </x-page-header>

    <x-alert type="success" />
    <x-alert type="error" />

    <x-data-table :rows="$users" empty="Tidak ada user ditemukan.">

        <x-slot name="filters">
            <x-filter-bar placeholder="Cari nama atau username..." :reset-route="route('menu-access.index')" />
        </x-slot>

        <x-slot name="thead">
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">ID User</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Nama / Username</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide hidden md:table-cell">Jenis User</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide text-center">Jumlah Menu Akses</th>
            <th class="text-right px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Aksi</th>
        </x-slot>

        @forelse($users as $user)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                    {{ $user->id_user }}
                </td>
                <td class="px-4 py-3">
                    <div class="flex flex-col">
                        <span class="font-medium text-slate-800">{{ $user->nama_user }}</span>
                        <span class="text-xs text-slate-500">{{ $user->username }}</span>
                    </div>
                </td>
                <td class="px-4 py-3 hidden md:table-cell">
                    <span class="text-xs bg-slate-100 text-slate-700 px-2.5 py-1 rounded font-medium">
                        {{ $user->jenisUser?->jenis_user ?? '—' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-center">
                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-primary-100 bg-primary-600 rounded-full">
                        {{ $menuCounts[$user->id_user] ?? 0 }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('menu-access.edit', $user->id_user) }}"
                        class="inline-flex items-center space-x-1 px-3 py-1.5 text-xs font-medium text-primary-700 bg-primary-50 border border-primary-200 rounded-lg hover:bg-primary-100 hover:text-primary-800 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Atur Akses</span>
                    </a>
                </td>
            </tr>
        @empty
        @endforelse

        <x-slot name="footer">
            {{ $users->links() }}
        </x-slot>

    </x-data-table>

</x-layouts.admin>
