<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
   public function index(Request $request)
{
    $jobs = Job::when($request->filled('search'), function ($query) use ($request) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('company_name', 'like', "%{$search}%")
              ->orWhere('role', 'like', "%{$search}%");
        });
    })->latest()->paginate(10)->withQueryString();

    return view('jobs.index', compact('jobs'));
}
   public function create()
{
    return view('jobs.form');
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'location' => 'nullable|string',
            'salary' => 'nullable|string',
            'job_link' => 'nullable|url',
            'applied_date' => 'nullable|date',
            'status' => 'required|string',
            'hr_contact' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
            'interview_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        Job::create($data);

        return redirect()->route('jobs.index')->with('success', 'Job added!');
    }

   public function edit(Job $job)
{
    return view('jobs.form', compact('job'));
}

    public function update(Request $request, Job $job)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'location' => 'nullable|string',
            'salary' => 'nullable|string',
            'job_link' => 'nullable|url',
            'applied_date' => 'nullable|date',
            'status' => 'required|string',
            'hr_contact' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
            'interview_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $job->update($data);

        return redirect()->route('jobs.index')->with('success', 'Job updated!');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return back()->with('success', 'Job deleted!');
    }
}