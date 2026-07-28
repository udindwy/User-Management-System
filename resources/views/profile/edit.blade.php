<x-layouts.admin title="Profil Saya">

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Profil Saya'],
        ]" />
    </x-slot>

    <div class="mb-6">
        <x-page-header
            title="Profil Saya"
            subtitle="Kelola informasi pribadi, foto, dan keamanan akun Anda"
            class="mb-0" />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 text-center">
                <h3 class="font-bold text-slate-800 text-left mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <svg class="h-5 w-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Foto Profil
                </h3>

                <div class="relative w-32 h-32 mx-auto mb-4 group rounded-full overflow-hidden border-4 border-white shadow-lg">
                    @php
                        $activeFoto = $user->fotos->first();
                    @endphp
                    @if($activeFoto && $activeFoto->foto)
                        <img src="{{ Storage::url($activeFoto->foto) }}" alt="Foto Profil" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-indigo-50 text-indigo-500 flex items-center justify-center text-4xl font-bold uppercase">
                            {{ substr($user->nama_user, 0, 2) }}
                        </div>
                    @endif
                    
                    <label for="foto-upload" class="absolute inset-0 bg-slate-900/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </label>
                </div>

                <form method="POST" action="{{ route('profile.foto') }}" enctype="multipart/form-data" id="form-upload-foto">
                    @csrf
                    <input type="file" name="foto" id="foto-upload" class="hidden" accept="image/*" onchange="document.getElementById('form-upload-foto').submit();">
                    <p class="text-xs text-slate-500 mb-4">Maksimal ukuran 2MB (JPG, PNG, WEBP)</p>
                    <label for="foto-upload" class="inline-block px-4 py-2 bg-indigo-50 text-indigo-700 font-semibold text-sm rounded-lg border border-indigo-100 hover:bg-indigo-100 cursor-pointer transition-colors w-full">
                        Pilih & Unggah Foto
                    </label>
                </form>
            </div>
            
            <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-xl shadow-sm text-white p-6 relative overflow-hidden">
                <svg class="absolute -right-4 -bottom-4 w-32 h-32 text-white opacity-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                <div class="relative z-10">
                    <p class="text-indigo-200 text-xs font-semibold uppercase tracking-wider mb-1">ID Pengguna</p>
                    <p class="text-xl font-bold mb-4">{{ $user->id_user }}</p>
                    <p class="text-indigo-200 text-xs font-semibold uppercase tracking-wider mb-1">Peran / Hak Akses</p>
                    <p class="font-medium bg-white/20 inline-block px-3 py-1 rounded-full text-sm">
                        {{ $user->jenisUser->jenis_user ?? 'Tidak Diketahui' }}
                    </p>
                </div>
            </div>
        </div>

        
        <div class="lg:col-span-2 space-y-6">
            
            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="font-bold text-slate-800 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                    </svg>
                    Informasi Pribadi
                </h3>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Lengkap <span class="text-rose-500">*</span></label>
                            <input type="text" name="nama_user" value="{{ old('nama_user', $user->nama_user) }}" required
                                class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors">
                            @error('nama_user') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Email <span class="text-rose-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors">
                            @error('email') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">No Handphone</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                                class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors">
                            @error('no_hp') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nomor WhatsApp</label>
                            <input type="text" name="wa" value="{{ old('wa', $user->wa) }}"
                                class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500 transition-colors">
                            @error('wa') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end">
                        <button type="submit" class="px-5 py-2.5 bg-primary-600 text-white font-medium text-sm rounded-lg hover:bg-primary-500 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="font-bold text-slate-800 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Keamanan Akun (Ganti Password)
                </h3>

                <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
                    @csrf @method('PUT')

                    <div class="space-y-4 max-w-md">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Password Saat Ini <span class="text-rose-500">*</span></label>
                            <input type="password" name="current_password" required
                                class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-colors">
                            @error('current_password') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Password Baru <span class="text-rose-500">*</span></label>
                            <input type="password" name="password" required
                                class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-colors">
                            @error('password') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Konfirmasi Password Baru <span class="text-rose-500">*</span></label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-colors">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 mt-6 flex justify-start">
                        <button type="submit" class="px-5 py-2.5 bg-amber-500 text-white font-medium text-sm rounded-lg hover:bg-amber-400 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                            Ganti Password
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</x-layouts.admin>
