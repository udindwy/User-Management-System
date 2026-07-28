<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public function render(): View|Closure|string
    {
        $menus = [];
        if (auth()->check()) {
            $user = auth()->user();
            
            // Get all menus assigned to this user (including Admin)
            // It strictly follows MENU_USER table check so it remains 100% dynamic
            $menus = \App\Models\Menu::active()
                ->whereHas('menuUsers', function ($query) use ($user) {
                    $query->active()->where('id_user', $user->id_user);
                })
                ->with('level')
                ->orderBy('id_level')
                ->orderBy('menu_id')
                ->get();
        }

        // Group by id_level (or level name if available) for rendering
        $groupedMenus = collect($menus)->groupBy(function ($menu) {
            return $menu->level ? $menu->level->level : 'Menu Lainnya';
        });

        return view('components.sidebar', compact('groupedMenus'));
    }
}
