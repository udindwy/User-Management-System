<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Menu;

class CheckMenuAccess
{
    
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        
        
        $path = '/' . ltrim($request->path(), '/');

        
        
        
        
        $menus = Menu::active()->orderByRaw('LENGTH(menu_link) DESC')->get();
        $matchedMenu = null;

        foreach ($menus as $menu) {
            $link = $menu->menu_link;
            
            if ($link === '/') {
                if ($path === '/') {
                    $matchedMenu = $menu;
                    break;
                }
            } else {
                $cleanLink = ltrim($link, '/');
                if ($request->is($cleanLink) || $request->is($cleanLink . '/*')) {
                    $matchedMenu = $menu;
                    
                    break;
                }
            }
        }

        
        if ($matchedMenu) {
            
            
            if ($user->id_user === 'USR001' || $matchedMenu->menu_id === 'P01') {
                return $next($request);
            }

            $hasAccess = \App\Models\MenuUser::active()
                ->where('id_user', $user->id_user)
                ->where('menu_id', $matchedMenu->menu_id)
                ->exists();

            if (!$hasAccess) {
                
                if ($matchedMenu->menu_id === 'U01') {
                    $hasU02 = \App\Models\MenuUser::active()
                        ->where('id_user', $user->id_user)
                        ->where('menu_id', 'U02')
                        ->exists();
                    if ($hasU02) {
                        $hasAccess = true;
                    }
                }
            }

            if (!$hasAccess) {
                
                abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk mengakses menu ini.');
            }
        }

        
        
        
        if ($matchedMenu && $request->isMethod('GET') && !$request->ajax()) {
            \App\Models\UserActivity::log(
                'Akses Menu', 
                "Mengakses halaman menu: {$matchedMenu->menu_name}", 
                $matchedMenu->menu_id
            );
        }

        return $next($request);
    }
}
