<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
   public function index(Request $request)
{
    $leads = Lead::when($request->filled('search'), function ($query) use ($request) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('business_name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('area', 'like', "%{$search}%");
        });
    })->latest()->paginate(10)->withQueryString();

    return view('leads.index', compact('leads'));
}

   public function create()
{
    return view('leads.form');
}


    public function store(Request $request)
    {
        $data = $request->validate([
            'business_name' => 'required|string|max:255',
            'category' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|string',
            'instagram' => 'nullable|string',
            'area' => 'nullable|string',
            'problem_identified' => 'nullable|string',
            'service_offered' => 'nullable|string',
            'source' => 'nullable|string',
            'status' => 'required|string',
            'follow_up_date' => 'nullable|date',
            'quoted_price' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        Lead::create($data);

        return redirect()->route('leads.index')->with('success', 'Lead added successfully!');
    }

   public function edit(Lead $lead)
{
    return view('leads.form', compact('lead'));
}

    public function update(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'business_name' => 'required|string|max:255',
            'category' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|string',
            'instagram' => 'nullable|string',
            'area' => 'nullable|string',
            'problem_identified' => 'nullable|string',
            'service_offered' => 'nullable|string',
            'source' => 'nullable|string',
            'status' => 'required|string',
            'follow_up_date' => 'nullable|date',
            'quoted_price' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $lead->update($data);

        return redirect()->route('leads.index')->with('success', 'Lead updated!');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return back()->with('success', 'Lead deleted!');
    }
}