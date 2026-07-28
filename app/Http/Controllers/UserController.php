<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\JenisUser;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['jenisUser'])->active();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_user', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('jenis')) {
            $query->where('id_jenis_user', $request->jenis);
        }

        if ($request->filled('status')) {
            $query->where('status_user', $request->status);
        }

        $users    = $query->orderBy('create_date', 'desc')->paginate(10)->withQueryString();
        $jenisUsers = JenisUser::all();

        return view('users.index', compact('users', 'jenisUsers'));
    }

    public function create()
    {
        $jenisUsers = JenisUser::all();
        return view('users.create', compact('jenisUsers'));
    }

    public function store(StoreUserRequest $request)
    {
        $actorId = Auth::user()->id_user;

        User::create([
            'id_user'       => $request->id_user,
            'nama_user'     => $request->nama_user,
            'username'      => $request->username,
            'password'      => Hash::make($request->password),
            'email'         => $request->email,
            'no_hp'         => $request->no_hp,
            'wa'            => $request->wa,
            'id_jenis_user' => $request->id_jenis_user,
            'status_user'   => $request->status_user,
            'delete_mark'   => '0',
            'create_by'     => $actorId,
            'create_date'   => now(),
        ]);

        $this->logActivity($actorId, "Tambah user: {$request->username}", 'Tambah Data');

        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $user = User::with(['jenisUser', 'fotos' => fn($q) => $q->active()->latest('create_date')])->active()->findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user       = User::active()->findOrFail($id);
        $jenisUsers = JenisUser::all();
        return view('users.edit', compact('user', 'jenisUsers'));
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $user    = User::active()->findOrFail($id);
        $actorId = Auth::user()->id_user;

        $user->update([
            'nama_user'     => $request->nama_user,
            'email'         => $request->email,
            'no_hp'         => $request->no_hp,
            'wa'            => $request->wa,
            'id_jenis_user' => $request->id_jenis_user,
            'status_user'   => $request->status_user,
            'update_by'     => $actorId,
            'update_date'   => now(),
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $this->logActivity($actorId, "Update data user: {$user->username}", 'Edit Data');

        return redirect()->route('users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $user    = User::active()->findOrFail($id);
        $actorId = Auth::user()->id_user;

        if ($user->id_user === $actorId) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->update([
            'delete_mark' => '1',
            'update_by'   => $actorId,
            'update_date' => now(),
        ]);

        $this->logActivity($actorId, "Hapus user: {$user->username}", 'Hapus Data');

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function uploadFoto(Request $request, string $id)
    {
        $request->validate([
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user    = User::active()->findOrFail($id);
        $actorId = Auth::user()->id_user;

        $path = $request->file('foto')->store("user-foto/{$id}", 'public');

        UserFoto::where('id_user', $id)->where('delete_mark', '0')
            ->update(['delete_mark' => '1', 'update_by' => $actorId, 'update_date' => now()]);

        UserFoto::create([
            'id_user'     => $id,
            'foto'        => $path,
            'delete_mark' => '0',
            'create_by'   => $actorId,
            'create_date' => now(),
        ]);

        $this->logActivity($actorId, "Upload foto user: {$user->username}", 'Edit Data');

        return back()->with('success', 'Foto berhasil diunggah.');
    }

    public function toggleStatus(string $id)
    {
        $user    = User::active()->findOrFail($id);
        $actorId = Auth::user()->id_user;

        $newStatus = $user->status_user === 'AKTIF' ? 'NONAKTIF' : 'AKTIF';

        $user->update([
            'status_user' => $newStatus,
            'update_by'   => $actorId,
            'update_date' => now(),
        ]);

        $label = $newStatus === 'AKTIF' ? 'diaktifkan' : 'dinonaktifkan';
        $this->logActivity($actorId, "User {$user->username} {$label}", 'Edit Data');

        return back()->with('success', "User berhasil {$label}.");
    }

    public function resetPassword(Request $request, string $id)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user    = User::active()->findOrFail($id);
        $actorId = Auth::user()->id_user;

        $user->update([
            'password'    => Hash::make($request->password),
            'update_by'   => $actorId,
            'update_date' => now(),
        ]);

        $this->logActivity($actorId, "Reset password user: {$user->username}", 'Edit Data');

        return back()->with('success', 'Password berhasil direset.');
    }

    private function logActivity(string $userId, string $description, string $action = 'Aksi Data'): void
    {
        UserActivity::log($action, $description, 'U01');
    }
}
