<x-layouts.admin title="Edit Menu">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Manajemen Menu', 'url' => route('menus.index')],
            ['label' => 'Edit Menu'],
        ]" />
    </x-slot>

    <div class="max-w-2xl">

        <x-page-header
            title="Edit Menu"
            subtitle="Perbarui data menu navigasi"
            back-url="{{ route('menus.index') }}" />

        <form method="POST" action="{{ route('menus.update', $menu->menu_id) }}">
            @csrf @method('PUT')

            <x-form-section title="Data Menu">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div class="sm:col-span-2 p-3 bg-slate-50 border border-slate-200 rounded-lg">
                        <p class="text-xs text-slate-500 mb-0.5">ID Menu</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $menu->menu_id }}</p>
                    </div>

                    <x-form-select
                        class="sm:col-span-2"
                        name="id_level"
                        label="Level Menu"
                        :required="true"
                        :selected="$menu->id_level"
                        :options="$levels->pluck('level', 'id_level')->toArray()" />

                    <x-form-input
                        class="sm:col-span-2"
                        name="menu_name"
                        label="Nama Menu"
                        :value="$menu->menu_name"
                        :required="true" />

                    <x-form-input
                        class="sm:col-span-2"
                        name="menu_link"
                        label="Link / Route"
                        :value="$menu->menu_link"
                        :required="true" />

                    <x-form-input
                        name="menu_icon"
                        label="Icon"
                        :value="$menu->menu_icon"
                        help="Gunakan nama icon lucide (contoh: users, home)" />

                    <x-form-select
                        name="parent_id"
                        label="Parent Menu"
                        :selected="$menu->parent_id"
                        placeholder="-- Tidak ada (Menu Utama) --"
                        :options="$parents->pluck('menu_name', 'menu_id')->toArray()" />

                </div>

                <x-slot name="actions">
                    <a href="{{ route('menus.index') }}"
                        class="px-4 py-2 text-sm text-slate-600 border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors font-medium">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2 bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold rounded-lg transition-colors">
                        Simpan Perubahan
                    </button>
                </x-slot>
            </x-form-section>

        </form>
    </div>

</x-layouts.admin>
