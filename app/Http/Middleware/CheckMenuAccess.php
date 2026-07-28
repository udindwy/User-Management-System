<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Menu;

class CheckMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // Dapatkan path atau route saat ini. Kita coba menggunakan path URI.
        // Contoh: /users, /menus, /activity-log
        $path = '/' . ltrim($request->path(), '/');

        // Cari menu yang link-nya me-match $path.
        // Karena link di DB bisa '/users' dan request path bisa '/users/create', kita harus cek base-nya.
        // Namun cara paling aman adalah memeriksa apakah URI terdaftar di tabel Menu
        $menus = Menu::active()->get();
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
                    // Kita asumsikan menu pertama yang match adalah yang paling relevan.
                    break;
                }
            }
        }

        // Jika rute ini terdaftar di tabel MENU, maka kita harus memvalidasi aksesnya
        if ($matchedMenu) {
            // Super Admin (USR001) memiliki hak istimewa (bypass) agar tidak pernah terkunci dari sistem
            if ($user->id_user === 'USR001') {
                return $next($request);
            }

            $hasAccess = \App\Models\MenuUser::active()
                ->where('id_user', $user->id_user)
                ->where('menu_id', $matchedMenu->menu_id)
                ->exists();

            if (!$hasAccess) {
                // Return 403 Forbidden
                abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk mengakses menu ini.');
            }
        }

        // Jika rute tidak terdaftar di tabel MENU (misalnya /profile), maka akses diperbolehkan (global).
        
        return $next($request);
    }
}
