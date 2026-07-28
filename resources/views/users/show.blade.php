<x-layouts.admin title="Detail User">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Manajemen User', 'url' => route('users.index')],
            ['label' => $user->nama_user],
        ]" />
    </x-slot>

    <x-alert type="success" />
    <x-alert type="error" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- ===== LEFT: Profile Card ===== --}}
        <div class="lg:col-span-1 space-y-5">

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 text-center">
                @php
                    $foto = $user->fotos->first();
                @endphp

                <div class="relative inline-block mb-4">
                    @if($foto)
                        <img src="{{ Storage::url($foto->foto) }}"
                            alt="{{ $user->nama_user }}"
                            class="w-16 h-16 rounded-full object-cover border-2 border-slate-200 shadow-sm">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gradient-primary flex items-center justify-center mx-auto shadow-sm">
                            <span class="text-white text-xl font-bold">
                                {{ strtoupper(substr($user->nama_user, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                </div>

                <h2 class="font-bold text-slate-800 text-base">{{ $user->nama_user }}</h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ $user->username }}</p>

                <div class="flex items-center justify-center mt-2">
                    <span class="inline-flex items-center gap-1.5 text-xs px-2.5 py-0.5 rounded-full font-medium
                        {{ $user->status_user === 'AKTIF'
                            ? 'bg-green-50 text-green-700 border border-green-200'
                            : 'bg-red-50 text-red-700 border border-red-200' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $user->status_user === 'AKTIF' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        <span>{{ $user->status_user }}</span>
                    </span>
                </div>

                <div class="flex items-center justify-center gap-2 mt-4">
                    <a href="{{ route('users.edit', $user->id_user) }}"
                        class="flex-1 py-2 text-sm font-medium bg-slate-800 hover:bg-slate-700 text-white rounded-lg transition-colors">
                        Edit
                    </a>
                    @if($user->id_user !== auth()->user()->id_user)
                        <form method="POST" action="{{ route('users.toggle-status', $user->id_user) }}" class="flex-1"
                            x-data @submit.prevent="if(confirm('Ubah status user ini?')) $el.submit()">
                            @csrf
                            <button type="submit"
                                class="w-full py-2 text-sm font-medium border rounded-lg transition-colors
                                    {{ $user->status_user === 'AKTIF'
                                        ? 'border-red-300 text-red-600 hover:bg-red-50'
                                        : 'border-green-300 text-green-600 hover:bg-green-50' }}">
                                {{ $user->status_user === 'AKTIF' ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <x-form-section title="Upload Foto">
                <form method="POST" action="{{ route('users.foto', $user->id_user) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="block">
                        <input id="foto" type="file" name="foto" accept="image/*"
                            class="w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0
                                file:text-xs file:font-medium file:bg-slate-100 file:text-slate-700
                                hover:file:bg-slate-200 transition-colors cursor-pointer mb-4 block">
                        @error('foto') <p class="text-xs text-red-500 mb-4">{{ $message }}</p> @enderror
                        <button type="submit"
                            class="w-full py-2 text-sm font-medium bg-primary-600 hover:bg-primary-500 text-white rounded-lg transition-colors mb-4">
                            Upload Foto
                        </button>
                    </div>
                </form>
                <p class="text-xs text-slate-400">JPG, JPEG, PNG, WebP. Maks. 2MB</p>
            </x-form-section>

            {{-- Reset Password --}}
            <x-form-section>
                <x-slot name="title">
                    <button @click="open = !open" x-data="{ open: false }" id="reset-pwd-btn"
                        class="flex items-center justify-between w-full text-sm font-semibold text-slate-700">
                        <span>Reset Password</span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </x-slot>

                <div x-data="{ open: false }" x-show="open" @click.window="if($event.target.closest('#reset-pwd-btn')) open = !open" x-collapse style="display: none;" class="mt-4">
                    <form method="POST" action="{{ route('users.reset-password', $user->id_user) }}">
                        @csrf
                        <div class="space-y-3">
                            <x-form-input
                                name="password"
                                type="password"
                                label="Password Baru"
                                placeholder="Min. 8 karakter"
                                :required="true" />
                                
                            <x-form-input
                                name="password_confirmation"
                                type="password"
                                label="Konfirmasi Password"
                                placeholder="Ulangi password"
                                :required="true" />
                                
                            <button type="submit"
                                class="w-full py-2 text-sm font-medium bg-amber-500 hover:bg-amber-400 text-white rounded-lg transition-colors">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </x-form-section>

        </div>

        {{-- ===== RIGHT: Detail Info ===== --}}
        <div class="lg:col-span-2 space-y-5">

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                <div class="px-5 py-4 border-b border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-700">Informasi Akun</h3>
                </div>
                <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-7 px-5 pt-5 pb-6">
                    @foreach([
                        ['ID User',     $user->id_user],
                        ['Nama Lengkap', $user->nama_user],
                        ['Username',    $user->username],
                        ['Email',       $user->email ?? '—'],
                        ['No. HP',      $user->no_hp ?? '—'],
                        ['WhatsApp',    $user->wa ?? '—'],
                        ['Jenis User',  $user->jenisUser?->jenis_user ?? '—'],
                    ] as [$label, $value])
                    <div>
                        <dt class="text-xs font-medium text-slate-500 mb-1">{{ $label }}</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $value }}</dd>
                    </div>
                    @endforeach
                </dl>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                <div class="px-5 py-4 border-b border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-700">Informasi Sistem</h3>
                </div>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-7 px-5 pt-5 pb-6">
                    @foreach([
                        ['Dibuat oleh',  $user->create_by],
                        ['Dibuat pada',  $user->create_date?->format('d M Y H:i') ?? '—'],
                        ['Diperbarui oleh', $user->update_by ?? '—'],
                        ['Diperbarui pada', $user->update_date?->format('d M Y H:i') ?? '—'],
                    ] as [$label, $value])
                    <div>
                        <dt class="text-xs font-medium text-slate-500 mb-1">{{ $label }}</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ $value }}</dd>
                    </div>
                    @endforeach
                </dl>
            </div>

            @if($user->id_user !== auth()->user()->id_user)
                <div class="bg-white rounded-xl border border-red-200 shadow-sm p-5">
                    <h3 class="text-sm font-semibold text-red-700 mb-1">Hapus User</h3>
                    <p class="text-xs text-slate-500 mb-3">User akan ditandai sebagai dihapus dan tidak dapat login.</p>
                    <form method="POST" action="{{ route('users.destroy', $user->id_user) }}"
                        x-data @submit.prevent="if(confirm('Hapus user {{ $user->username }}? Tindakan ini tidak dapat dibatalkan.')) $el.submit()">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-sm font-semibold rounded-lg transition-colors">
                            Hapus User
                        </button>
                    </form>
                </div>
            @endif

        </div>

    </div>

</x-layouts.admin>
