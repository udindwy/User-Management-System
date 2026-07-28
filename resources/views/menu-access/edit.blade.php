<x-layouts.admin title="Atur Hak Akses Menu">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Hak Akses Menu', 'url' => route('menu-access.index')],
            ['label' => 'Atur Akses'],
        ]" />
    </x-slot>

    <div class="w-full">

        <x-page-header
            title="Hak Akses: {{ $user->nama_user }}"
            subtitle="Centang menu yang boleh diakses oleh pengguna ini"
            back-url="{{ route('menu-access.index') }}" />

        <form method="POST" action="{{ route('menu-access.update', $user->id_user) }}">
            @csrf @method('PUT')

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
                
                @forelse($groupedMenus as $levelId => $menusInLevel)
                    <div class="border-b border-slate-100 last:border-0">
                        <div class="bg-slate-50 px-5 py-3 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="font-semibold text-slate-700 text-sm">Level: {{ $levelId ?? 'Lainnya' }}</h3>
                            <button type="button" 
                                onclick="document.querySelectorAll('.chk-{{ $levelId }}').forEach(e => e.checked = !e.checked)"
                                class="text-xs text-primary-600 hover:text-primary-700 font-medium">
                                Toggle Semua
                            </button>
                        </div>
                        
                        <div class="p-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($menusInLevel as $menu)
                                <label class="flex items-start space-x-3 cursor-pointer group p-2 -m-2 rounded hover:bg-slate-50 transition-colors">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" name="menus[]" value="{{ $menu->menu_id }}"
                                            class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500 chk-{{ $levelId }}"
                                            {{ in_array($menu->menu_id, $userMenus) ? 'checked' : '' }}>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-slate-800 group-hover:text-primary-600 transition-colors">
                                            {{ $menu->menu_name }}
                                        </span>
                                        <span class="text-xs text-slate-500">
                                            {{ $menu->menu_link }}
                                        </span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="p-5 text-center text-slate-500 text-sm">
                        Belum ada menu yang terdaftar di sistem.
                    </div>
                @endforelse
                
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('menu-access.index') }}"
                    class="px-4 py-2 text-sm text-slate-600 border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors font-medium">
                    Batal
                </a>
                <button type="submit"
                    class="px-5 py-2 bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold rounded-lg transition-colors">
                    Simpan Hak Akses
                </button>
            </div>

        </form>

    </div>

</x-layouts.admin>
