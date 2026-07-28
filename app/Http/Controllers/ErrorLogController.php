<?php

namespace App\Http\Controllers;

use App\Models\LErrorApplication;
use Illuminate\Http\Request;

class ErrorLogController extends Controller
{
    public function index(Request $request)
    {
        $query = LErrorApplication::with(['user'])->active();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('error_message', 'like', "%{$search}%")
                  ->orWhere('modules', 'like', "%{$search}%")
                  ->orWhere('controller', 'like', "%{$search}%")
                  ->orWhere('function', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('error_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('error_date', '<=', $request->date_to);
        }

        $errors = $query->orderBy('create_date', 'desc')->paginate(15)->withQueryString();

        return view('error-log.index', compact('errors'));
    }

    public function show(string $id)
    {
        $error = LErrorApplication::with(['user'])->active()->findOrFail($id);
        $paramJson = json_decode($error->param, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $error->param_array = $paramJson;
        }

        return view('error-log.show', compact('error'));
    }
}
