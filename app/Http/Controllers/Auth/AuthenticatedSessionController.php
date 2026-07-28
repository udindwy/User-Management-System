<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\UserActivity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        UserActivity::create([
            'id_user'     => Auth::user()->id_user,
            'diskripsi'   => 'Login ke sistem',
            'status'      => 'SUCCESS',
            'menu_id'     => null,
            'delete_mark' => '0',
            'create_by'   => Auth::user()->id_user,
            'create_date' => now(),
        ]);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        UserActivity::create([
            'id_user'     => Auth::user()->id_user,
            'diskripsi'   => 'Logout dari sistem',
            'status'      => 'SUCCESS',
            'menu_id'     => null,
            'delete_mark' => '0',
            'create_by'   => Auth::user()->id_user,
            'create_date' => now(),
        ]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
