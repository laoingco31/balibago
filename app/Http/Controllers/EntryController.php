<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $entries = Entry::when($search, function ($query, $search) {
            return $query->where('description', 'LIKE', "%{$search}%")
                         ->orWhere('branch', 'LIKE', "%{$search}%")
                         ->orWhere('received_by', 'LIKE', "%{$search}%");
        })->latest()->get();

        // Fetch latest 10 activity logs
        $activityLogs = ActivityLog::latest()->take(10)->get();

        return view('entries.index', compact('entries', 'activityLogs'));
    }

    public function create()
    {
        return view('entries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_received' => 'required|date',
            'branch' => 'required|string',
            'description' => 'required|string',
            'quantity' => 'required|integer',
            'amount' => 'required|numeric',
            'total' => 'required|numeric',
            'date_release' => 'nullable|date',
            'received_by' => 'required|string',
        ]);

        $entry = Entry::create($request->all());

        // Log activity
        ActivityLog::create([
            'activity' => "📝 Added a new entry: {$entry->description} (ID: {$entry->id})",
        ]);

        return redirect()->route('entries.index')->with('success', 'Entry added successfully.');
    }

    public function update(Request $request, $id)
    {
        $entry = Entry::findOrFail($id); // Ensure the entry exists

        $request->validate([
            'date_release' => 'nullable|date',
            'received_by' => 'required|string',
        ]);

        $oldValues = $entry->getOriginal(); // Store old values before updating
        $entry->update([
            'date_release' => $request->date_release,
            'received_by' => $request->received_by,
        ]);

        // Log what changed
        $changes = [];
        foreach ($entry->getChanges() as $field => $newValue) {
            if ($field !== 'updated_at' && (!empty($oldValues[$field]) || !empty($newValue))) {
                $oldValue = $oldValues[$field] ?? 'N/A';
                $changes[] = ucfirst(str_replace('_', ' ', $field)) . " changed from '{$oldValue}' to '{$newValue}'";
            }
        }

        if (!empty($changes)) {
            ActivityLog::create([
                'activity' => "✏️ Edited Entry ID: {$entry->id} (" . implode(', ', $changes) . ")",
            ]);
        }

        return redirect()->route('entries.index')->with('success', 'Entry updated successfully.');
    }

    public function destroy(Entry $entry)
    {
        $entryId = $entry->id;
        $entryDescription = $entry->description;

        $entry->delete();

        ActivityLog::create([
            'activity' => "🗑️ Deleted Entry ID: {$entryId} ({$entryDescription})",
        ]);

        return redirect()->route('entries.index')->with('success', 'Entry deleted successfully.');
    }
}
