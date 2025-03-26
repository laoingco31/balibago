<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve all pending entries where 'received_by' is marked as "Pending"
        $pendingEntries = Entry::where('received_by', 'Pending')->get();

        // Fetch the latest 10 activity logs
        $activityLogs = ActivityLog::latest()->take(10)->get();

        // Pass both pendingEntries and activityLogs to the dashboard view
        return view('dashboard', [
            'pendingEntries' => $pendingEntries,
            'activityLogs' => $activityLogs,
        ]);
    }
}
