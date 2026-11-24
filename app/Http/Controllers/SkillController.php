<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::latest()->paginate(10);
        return view('skills.index', compact('skills'));
    }

   public function create()
{
    $skill = new Skill();

    return view('skills.form', compact('skill'));
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string',
            'progress' => 'required|integer|min:0|max:100',
            'notes' => 'nullable|string',
            'target_date' => 'nullable|date',
        ]);

        Skill::create($data);

        return redirect()->route('skills.index')->with('success', 'Skill added!');
    }

    public function edit(Skill $skill)
{
    return view('skills.form', compact('skill'));
}

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string',
            'progress' => 'required|integer|min:0|max:100',
            'notes' => 'nullable|string',
            'target_date' => 'nullable|date',
        ]);

        $skill->update($data);

        return redirect()->route('skills.index')->with('success', 'Skill updated!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return back()->with('success', 'Skill deleted!');
    }
}