<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use App\Models\UserActivity;
use App\Models\LErrorApplication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isAdmin = $user->id_jenis_user === 'ADM';

        $totalUsers = $isAdmin ? User::active()->count() : 0;
        $totalMenus = $isAdmin ? Menu::active()->count() : 0;
        
        $activityQuery = UserActivity::active();
        if (!$isAdmin) {
            $activityQuery->where('id_user', $user->id_user);
        }
        $totalActivities = $activityQuery->count();
        
        $totalErrors = $isAdmin ? LErrorApplication::active()->count() : 0;
    
        $recentActivitiesQuery = UserActivity::with(['user', 'menu'])->active();
        if (!$isAdmin) {
            $recentActivitiesQuery->where('id_user', $user->id_user);
        }
        $recentActivities = $recentActivitiesQuery->orderBy('create_date', 'desc')->take(5)->get();

        $recentErrors = collect();
        if ($isAdmin) {
            $recentErrors = LErrorApplication::with(['user'])
                ->active()
                ->orderBy('create_date', 'desc')
                ->take(5)
                ->get();
        }

        return view('dashboard', compact(
            'isAdmin',
            'totalUsers', 
            'totalMenus', 
            'totalActivities', 
            'totalErrors', 
            'recentActivities', 
            'recentErrors'
        ));
    }
}
