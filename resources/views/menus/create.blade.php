<x-layouts.admin title="Tambah Menu">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Manajemen Menu', 'url' => route('menus.index')],
            ['label' => 'Tambah Menu'],
        ]" />
    </x-slot>

    <div class="max-w-2xl">

        <x-page-header
            title="Tambah Menu"
            subtitle="Buat menu navigasi baru"
            back-url="{{ route('menus.index') }}" />

        <form method="POST" action="{{ route('menus.store') }}">
            @csrf

            <x-form-section title="Data Menu">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <x-form-input
                        name="menu_id"
                        label="ID Menu"
                        placeholder="M01, U01..."
                        :required="true" />

                    <x-form-select
                        name="id_level"
                        label="Level Menu"
                        :required="true"
                        :options="$levels->pluck('level', 'id_level')->toArray()" />

                    <x-form-input
                        class="sm:col-span-2"
                        name="menu_name"
                        label="Nama Menu"
                        placeholder="Contoh: Manajemen User"
                        :required="true" />

                    <x-form-input
                        class="sm:col-span-2"
                        name="menu_link"
                        label="Link / Route"
                        placeholder="Contoh: /users atau users.index"
                        :required="true" />

                    <x-form-input
                        name="menu_icon"
                        label="Icon"
                        placeholder="Contoh: users"
                        help="Gunakan nama icon lucide (contoh: users, home)" />

                    <x-form-select
                        name="parent_id"
                        label="Parent Menu"
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
                        Simpan Menu
                    </button>
                </x-slot>
            </x-form-section>

        </form>
    </div>

</x-layouts.admin>
