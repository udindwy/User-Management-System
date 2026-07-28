<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = UserActivity::with(['user', 'menu'])->active();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('diskripsi', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('nama_user', 'like', "%{$search}%")
                         ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('action')) {
            $query->where('status', $request->action);
        }

        if ($request->filled('user_id')) {
            $query->where('id_user', $request->user_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('create_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('create_date', '<=', $request->date_to);
        }

        $activities = $query->orderBy('create_date', 'desc')->paginate(15)->withQueryString();
        
        $users = User::active()->orderBy('nama_user')->get();
        $actions = UserActivity::active()->select('status')->distinct()->pluck('status')->filter()->toArray();

        return view('activity-log.index', compact('activities', 'users', 'actions'));
    }
}
