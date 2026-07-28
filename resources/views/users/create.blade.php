<x-layouts.admin title="Tambah User">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Manajemen User', 'url' => route('users.index')],
            ['label' => 'Tambah User'],
        ]" />
    </x-slot>

    <div class="w-full">

        <x-page-header
            title="Tambah User"
            subtitle="Buat akun pengguna baru"
            back-url="{{ route('users.index') }}" />

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <x-form-section title="Data Pengguna">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <x-form-input
                        name="id_user"
                        label="ID User"
                        placeholder="USR004"
                        :required="true" />

                    <x-form-select
                        name="id_jenis_user"
                        label="Jenis User"
                        :required="true"
                        :options="$jenisUsers->pluck('jenis_user', 'id_jenis_user')->toArray()" />

                    <x-form-input
                        class="sm:col-span-2"
                        name="nama_user"
                        label="Nama Lengkap"
                        placeholder="Nama lengkap user"
                        :required="true" />

                    <x-form-input
                        name="username"
                        label="Username"
                        placeholder="username"
                        :required="true" />

                    <x-form-input
                        name="email"
                        type="email"
                        label="Email"
                        placeholder="email@domain.com" />

                    <x-form-input
                        name="password"
                        type="password"
                        label="Password"
                        placeholder="Min. 8 karakter"
                        :required="true" />

                    <x-form-input
                        name="no_hp"
                        label="No. HP"
                        placeholder="08xxxxxxxxxx" />

                    <x-form-input
                        name="wa"
                        label="WhatsApp"
                        placeholder="08xxxxxxxxxx" />

                    <x-form-select
                        name="status_user"
                        label="Status"
                        :required="true"
                        :selected="old('status_user', 'AKTIF')"
                        :options="['AKTIF' => 'Aktif', 'NONAKTIF' => 'Nonaktif']"
                        placeholder="" />

                </div>

                <x-slot name="actions">
                    <a href="{{ route('users.index') }}"
                        class="px-4 py-2 text-sm text-slate-600 border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors font-medium">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2 bg-primary-600 hover:bg-primary-500 text-white text-sm font-semibold rounded-lg transition-colors">
                        Simpan User
                    </button>
                </x-slot>
            </x-form-section>

        </form>
    </div>

</x-layouts.admin>
