<x-layouts.admin title="Edit User">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Manajemen User', 'url' => route('users.index')],
            ['label' => 'Edit User'],
        ]" />
    </x-slot>

    <div class="w-full">

        <x-page-header
            title="Edit User"
            subtitle="Perbarui data pengguna"
            back-url="{{ route('users.show', $user->id_user) }}" />

        <form method="POST" action="{{ route('users.update', $user->id_user) }}">
            @csrf @method('PUT')

            <x-form-section title="Data Pengguna">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    <div class="sm:col-span-2 p-3 bg-slate-50 border border-slate-200 rounded-lg">
                        <p class="text-xs text-slate-500 mb-0.5">ID User</p>
                        <p class="text-sm font-semibold text-slate-800">{{ $user->id_user }}</p>
                    </div>

                    <x-form-input
                        class="sm:col-span-2"
                        name="nama_user"
                        label="Nama Lengkap"
                        :value="$user->nama_user"
                        :required="true" />

                    <x-form-input
                        name="username"
                        label="Username"
                        :value="$user->username"
                        :required="true" />

                    <x-form-input
                        name="email"
                        type="email"
                        label="Email"
                        :value="$user->email" />

                    <x-form-input
                        name="no_hp"
                        label="No. HP"
                        :value="$user->no_hp" />

                    <x-form-input
                        name="wa"
                        label="WhatsApp"
                        :value="$user->wa" />

                    <x-form-select
                        name="id_jenis_user"
                        label="Jenis User"
                        :required="true"
                        :selected="$user->id_jenis_user"
                        :options="$jenisUsers->pluck('jenis_user', 'id_jenis_user')->toArray()" />

                    <x-form-select
                        name="status_user"
                        label="Status"
                        :selected="$user->status_user"
                        :options="['AKTIF' => 'Aktif', 'NONAKTIF' => 'Nonaktif']"
                        placeholder="" />

                </div>

                <x-slot name="actions">
                    <a href="{{ route('users.show', $user->id_user) }}"
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
