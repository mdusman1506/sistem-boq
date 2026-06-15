<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        // Optional filtering by role or date could be added here
        if ($request->has('role') && $request->role != '') {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        if ($request->has('action_type') && $request->action_type != '') {
            $query->where('action', 'like', '%' . $request->action_type . '%');
        }

        $logs = $query->paginate(20);

        return view('audit.index', compact('logs'));
    }
}
