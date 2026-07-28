<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuUser;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuAccessController extends Controller
{
    public function index(Request $request)
    {
        $query = User::active();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_user', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('id_user', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10)->withQueryString();

        // Count menus per user
        $menuCounts = MenuUser::active()
            ->select('id_user', DB::raw('count(*) as total'))
            ->groupBy('id_user')
            ->pluck('total', 'id_user');

        return view('menu-access.index', compact('users', 'menuCounts'));
    }

    public function edit(string $id)
    {
        $user = User::active()->findOrFail($id);
        
        $menus = Menu::active()->orderBy('id_level')->orderBy('menu_id')->get();
        $userMenus = MenuUser::active()->where('id_user', $id)->pluck('menu_id')->toArray();

        // Group menus logically by level (Main Menu, Sub Menu, etc. based on id_level)
        // Usually, users want to see it grouped by Parent if it's a hierarchy, but let's group by Level as per standard
        $groupedMenus = $menus->groupBy('id_level');

        return view('menu-access.edit', compact('user', 'groupedMenus', 'userMenus'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::active()->findOrFail($id);
        $actorId = Auth::user()->id_user;
        
        $selectedMenuIds = $request->input('menus', []);

        DB::transaction(function () use ($user, $selectedMenuIds, $actorId) {
            $currentAccess = MenuUser::active()->where('id_user', $user->id_user)->get();
            $currentMenuIds = $currentAccess->pluck('menu_id')->toArray();

            $toRemove = array_diff($currentMenuIds, $selectedMenuIds);
            $toAdd = array_diff($selectedMenuIds, $currentMenuIds);

            // Remove (soft delete)
            if (!empty($toRemove)) {
                MenuUser::active()
                    ->where('id_user', $user->id_user)
                    ->whereIn('menu_id', $toRemove)
                    ->update([
                        'delete_mark' => '1',
                        'update_by' => $actorId,
                        'update_date' => now()
                    ]);
            }

            // Add
            foreach ($toAdd as $menuId) {
                // Check if it exists but is deleted to restore, or create new
                $existing = MenuUser::where('id_user', $user->id_user)
                    ->where('menu_id', $menuId)
                    ->first();

                if ($existing) {
                    $existing->restore($actorId);
                } else {
                    MenuUser::create([
                        'id_user' => $user->id_user,
                        'menu_id' => $menuId,
                        'create_date' => now(),
                        'create_time' => now(),
                        'delete_mark' => '0',
                    ]);
                }
            }
        });

        $this->logActivity($actorId, "Mengubah hak akses menu untuk user: {$user->username}");

        return redirect()->route('menu-access.index')->with('success', 'Hak akses berhasil diperbarui.');
    }

    private function logActivity(string $userId, string $description): void
    {
        UserActivity::create([
            'id_user'     => $userId,
            'diskripsi'   => $description,
            'status'      => 'SUCCESS',
            'delete_mark' => '0',
            'create_by'   => $userId,
            'create_date' => now(),
        ]);
    }
}
