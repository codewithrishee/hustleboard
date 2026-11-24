<?php

namespace App\Http\Controllers;

use App\Models\DailyActivity;
use Illuminate\Http\Request;

class DailyActivityController extends Controller
{
    public function index()
{
    $activities = DailyActivity::latest('activity_date')->paginate(10);
    return view('activities.index', compact('activities'));
}


   public function create()
{
    return view('activities.form');
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'activity_date' => 'required|date|unique:daily_activities,activity_date',
            'jobs_applied' => 'required|integer|min:0',
            'leads_found' => 'required|integer|min:0',
            'calls_made' => 'required|integer|min:0',
            'messages_sent' => 'required|integer|min:0',
            'follow_ups' => 'required|integer|min:0',
            'replies_received' => 'required|integer|min:0',
            'meetings' => 'required|integer|min:0',
            'clients_won' => 'required|integer|min:0',
            'learning_minutes' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        DailyActivity::create($data);

        return redirect()->route('activities.index')->with('success', 'Activity saved!');
    }

    public function edit(DailyActivity $activity)
{
    return view('activities.form', compact('activity'));
}

    public function update(Request $request, DailyActivity $activity)
    {
        $data = $request->validate([
            'activity_date' => 'required|date|unique:daily_activities,activity_date,' . $activity->id,
            'jobs_applied' => 'required|integer|min:0',
            'leads_found' => 'required|integer|min:0',
            'calls_made' => 'required|integer|min:0',
            'messages_sent' => 'required|integer|min:0',
            'follow_ups' => 'required|integer|min:0',
            'replies_received' => 'required|integer|min:0',
            'meetings' => 'required|integer|min:0',
            'clients_won' => 'required|integer|min:0',
            'learning_minutes' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);

        $activity->update($data);

        return redirect()->route('activities.index')->with('success', 'Activity updated!');
    }

    public function destroy(DailyActivity $activity)
    {
        $activity->delete();

        return back()->with('success', 'Activity deleted!');
    }
}