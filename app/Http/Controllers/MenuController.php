<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use App\Models\MenuLevel;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with(['level', 'parent'])->active();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('menu_name', 'like', "%{$search}%")
                  ->orWhere('menu_link', 'like', "%{$search}%")
                  ->orWhere('menu_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('level')) {
            $query->where('id_level', $request->level);
        }

        $menus = $query->orderBy('id_level')->orderBy('menu_id')->paginate(10)->withQueryString();
        $levels = MenuLevel::all();

        return view('menus.index', compact('menus', 'levels'));
    }

    public function create()
    {
        $levels = MenuLevel::all();
        $parents = Menu::active()->where('id_level', 'LVL001')->get(); // Biasanya parent itu Main Menu
        return view('menus.create', compact('levels', 'parents'));
    }

    public function store(StoreMenuRequest $request)
    {
        $actorId = Auth::user()->id_user;

        Menu::create([
            'menu_id'     => $request->menu_id,
            'id_level'    => $request->id_level,
            'menu_name'   => $request->menu_name,
            'menu_link'   => $request->menu_link,
            'menu_icon'   => $request->menu_icon,
            'parent_id'   => $request->parent_id,
            'delete_mark' => '0',
            'create_by'   => $actorId,
            'create_date' => now()->toDateString(),
        ]);

        $this->logActivity($actorId, "Tambah menu: {$request->menu_name}");

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $menu    = Menu::active()->findOrFail($id);
        $levels  = MenuLevel::all();
        $parents = Menu::active()->where('menu_id', '!=', $id)->where('id_level', 'LVL001')->get();
        return view('menus.edit', compact('menu', 'levels', 'parents'));
    }

    public function update(UpdateMenuRequest $request, string $id)
    {
        $menu    = Menu::active()->findOrFail($id);
        $actorId = Auth::user()->id_user;

        $menu->update([
            'id_level'    => $request->id_level,
            'menu_name'   => $request->menu_name,
            'menu_link'   => $request->menu_link,
            'menu_icon'   => $request->menu_icon,
            'parent_id'   => $request->parent_id,
            'update_by'   => $actorId,
            'update_date' => now()->toDateString(),
        ]);

        $this->logActivity($actorId, "Edit menu: {$menu->menu_name}");

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $menu    = Menu::active()->findOrFail($id);
        $actorId = Auth::user()->id_user;

        $menu->softDelete($actorId);

        $this->logActivity($actorId, "Hapus menu: {$menu->menu_name}");

        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
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
