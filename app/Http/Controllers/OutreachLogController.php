<?php

namespace App\Http\Controllers;

use App\Models\OutreachLog;
use App\Models\Lead;
use Illuminate\Http\Request;

class OutreachLogController extends Controller
{
    public function index()
{
    $outreach = OutreachLog::with('lead')->latest()->paginate(10);
    return view('outreach.index', compact('outreach'));
}

    public function create()
{
    $leads = Lead::orderBy('business_name')->get();
    return view('outreach.form', compact('leads'));
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'lead_id' => 'nullable|exists:leads,id',
            'method' => 'required|string',
            'message' => 'nullable|string',
            'response_status' => 'required|string',
            'response' => 'nullable|string',
            'contacted_at' => 'required|date',
            'follow_up_date' => 'nullable|date',
        ]);

        OutreachLog::create($data);

        return redirect()->route('outreach.index')->with('success', 'Outreach saved!');
    }

    public function edit(OutreachLog $outreach)
{
    $leads = Lead::orderBy('business_name')->get();
    return view('outreach.form', compact('outreach', 'leads'));
}

    public function update(Request $request, OutreachLog $outreach)
    {
        $data = $request->validate([
            'lead_id' => 'nullable|exists:leads,id',
            'method' => 'required|string',
            'message' => 'nullable|string',
            'response_status' => 'required|string',
            'response' => 'nullable|string',
            'contacted_at' => 'required|date',
            'follow_up_date' => 'nullable|date',
        ]);

        $outreach->update($data);

        return redirect()->route('outreach.index')->with('success', 'Outreach updated!');
    }

    public function destroy(OutreachLog $outreach)
    {
        $outreach->delete();

        return back()->with('success', 'Outreach deleted!');
    }
}