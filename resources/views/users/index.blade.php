<x-layouts.admin title="Manajemen User">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Manajemen User'],
        ]" />
    </x-slot>

    <x-page-header title="Manajemen User" subtitle="Kelola seluruh data pengguna sistem">
        <x-slot name="actions">
            <a href="{{ route('users.create') }}"
                class="inline-flex items-center space-x-2 px-4 py-2 bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah User</span>
            </a>
        </x-slot>
    </x-page-header>

    <x-alert type="success" />
    <x-alert type="error" />

    <x-data-table :rows="$users" empty="Tidak ada user ditemukan.">

        <x-slot name="filters">
            <x-filter-bar placeholder="Cari nama, username, email..." :reset-route="route('users.index')">
                <x-form-select name="jenis" placeholder="Semua Jenis"
                    :selected="request('jenis')"
                    :options="$jenisUsers->pluck('jenis_user', 'id_jenis_user')->toArray()"
                    class="w-auto min-w-36" />

                <x-form-select name="status" placeholder="Semua Status"
                    :selected="request('status')"
                    :options="['AKTIF' => 'Aktif', 'NONAKTIF' => 'Nonaktif']"
                    class="w-auto min-w-32" />
            </x-filter-bar>
        </x-slot>

        <x-slot name="thead">
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">User</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide hidden md:table-cell">Username</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide hidden lg:table-cell">Jenis</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Status</th>
            <th class="text-right px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Aksi</th>
        </x-slot>

        @forelse($users as $user)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-full bg-gradient-primary flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-sm font-semibold">
                                {{ strtoupper(substr($user->nama_user, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <p class="font-medium text-slate-800 leading-tight">{{ $user->nama_user }}</p>
                            <p class="text-xs text-slate-500">{{ $user->email ?? '—' }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 hidden md:table-cell">
                    <code class="text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded">{{ $user->username }}</code>
                </td>
                <td class="px-4 py-3 hidden lg:table-cell">
                    <span class="text-xs bg-blue-50 text-blue-700 border border-blue-200 px-2 py-0.5 rounded-full font-medium">
                        {{ $user->jenisUser?->jenis_user ?? '—' }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <span class="inline-flex items-center space-x-1 text-xs px-2 py-0.5 rounded-full font-medium
                        {{ $user->status_user === 'AKTIF'
                            ? 'bg-green-50 text-green-700 border border-green-200'
                            : 'bg-red-50 text-red-700 border border-red-200' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $user->status_user === 'AKTIF' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        <span>{{ $user->status_user }}</span>
                    </span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center justify-end space-x-1">
                        <a href="{{ route('users.show', $user->id_user) }}"
                            class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors" title="Detail">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                        
                        <a href="{{ route('users.edit', $user->id_user) }}"
                            class="p-1.5 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        @if($user->id_user !== auth()->user()->id_user)
                            <form method="POST" action="{{ route('users.destroy', $user->id_user) }}"
                                x-data
                                @submit.prevent="if(confirm('Hapus user {{ $user->username }}?')) $el.submit()">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
        @endforelse

        <x-slot name="footer">
            {{ $users->links() }}
        </x-slot>

    </x-data-table>

</x-layouts.admin>
