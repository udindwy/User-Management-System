<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserFoto;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = User::with(['jenisUser', 'fotos' => fn($q) => $q->active()->latest('create_date')])->findOrFail(Auth::user()->id_user);

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id_user);

        $request->validate([
            'nama_user' => ['required', 'string', 'max:60'],
            'email'     => ['required', 'string', 'email', 'max:60', Rule::unique('USER')->ignore($user->id_user, 'id_user')],
            'no_hp'     => ['nullable', 'string', 'max:30'],
            'wa'        => ['nullable', 'string', 'max:30'],
        ]);

        $user->update([
            'nama_user'   => $request->nama_user,
            'email'       => $request->email,
            'no_hp'       => $request->no_hp,
            'wa'          => $request->wa,
            'update_by'   => $user->id_user,
            'update_date' => now(),
        ]);

        UserActivity::log('Edit Data', "Memperbarui profil mandiri", 'P01');

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id_user);

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password'    => Hash::make($request->password),
            'update_by'   => $user->id_user,
            'update_date' => now(),
        ]);

        UserActivity::log('Edit Data', "Mengganti password akun mandiri", 'P01');

        return back()->with('success', 'Password berhasil diubah.');
    }

    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user = Auth::user();
        $id = $user->id_user;

        $path = $request->file('foto')->store("user-foto/{$id}", 'public');

        UserFoto::where('id_user', $id)->where('delete_mark', '0')
            ->update(['delete_mark' => '1', 'update_by' => $id, 'update_date' => now()]);

        UserFoto::create([
            'id_user'     => $id,
            'foto'        => $path,
            'delete_mark' => '0',
            'create_by'   => $id,
            'create_date' => now(),
        ]);

        UserActivity::log('Edit Data', "Memperbarui foto profil mandiri", 'P01');

        return back()->with('success', 'Foto profil berhasil diunggah.');
    }
}
