<x-layouts.admin title="Manajemen Menu">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Manajemen Menu'],
        ]" />
    </x-slot>

    <x-page-header title="Manajemen Menu" subtitle="Kelola menu navigasi sistem">
        <x-slot name="actions">
            <a href="{{ route('menus.create') }}"
                class="inline-flex items-center space-x-2 px-4 py-2 bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Tambah Menu</span>
            </a>
        </x-slot>
    </x-page-header>

    <x-alert type="success" />
    <x-alert type="error" />

    <x-data-table :rows="$menus" empty="Tidak ada menu ditemukan.">

        <x-slot name="filters">
            <x-filter-bar placeholder="Cari nama, id, link menu..." :reset-route="route('menus.index')">
                <x-form-select name="level" placeholder="Semua Level"
                    :selected="request('level')"
                    :options="$levels->pluck('level', 'id_level')->toArray()"
                    class="w-auto min-w-36" />
            </x-filter-bar>
        </x-slot>

        <x-slot name="thead">
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">ID Menu</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Nama Menu</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide hidden md:table-cell">Link</th>
            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide hidden lg:table-cell">Level / Parent</th>
            <th class="text-right px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Aksi</th>
        </x-slot>

        @forelse($menus as $menu)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-4 py-3 text-sm text-slate-600 font-medium">
                    {{ $menu->menu_id }}
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0 text-slate-500">
                            @if($menu->menu_icon)
                                <span class="text-xs font-mono font-bold" title="{{ $menu->menu_icon }}">
                                    {{ strtoupper(substr(str_replace('lucide-', '', $menu->menu_icon), 0, 2)) }}
                                </span>
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-slate-800 leading-tight">{{ $menu->menu_name }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 hidden md:table-cell">
                    @if($menu->menu_link !== '#' && $menu->menu_link !== '')
                        <code class="text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded">{{ $menu->menu_link }}</code>
                    @else
                        <span class="text-slate-400 text-xs">—</span>
                    @endif
                </td>
                <td class="px-4 py-3 hidden lg:table-cell">
                    <div class="flex flex-col space-y-1">
                        <span class="text-xs bg-blue-50 text-blue-700 border border-blue-200 px-2 py-0.5 rounded-full font-medium w-max">
                            {{ $menu->level?->level ?? '—' }}
                        </span>
                        @if($menu->parent)
                            <span class="text-xs text-slate-500 flex items-center space-x-1">
                                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                                <span>{{ $menu->parent->menu_name }}</span>
                            </span>
                        @endif
                    </div>
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center justify-end space-x-1">
                        <a href="{{ route('menus.edit', $menu->menu_id) }}"
                            class="p-1.5 text-slate-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('menus.destroy', $menu->menu_id) }}"
                            x-data
                            @submit.prevent="if(confirm('Hapus menu {{ $menu->menu_name }}?')) $el.submit()">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
        @endforelse

        <x-slot name="footer">
            {{ $menus->links() }}
        </x-slot>

    </x-data-table>

</x-layouts.admin>
