<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::withCount('classes')->orderBy('name')->paginate(15);
        return view('modules.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:subjects',
            'description' => 'nullable|string',
            'is_active' => 'required|in:0,1'
        ]);

        // Convert is_active to boolean
        $validated['is_active'] = (bool) $validated['is_active'];

        Subject::create($validated);

        return redirect()->route('subjects.index')
                        ->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $subject->load(['classes']);
        
        // Get classes and teachers separately to avoid relationship issues
        $classes = $subject->classes()->with(['classLevel', 'stream'])->get();
        $teachers = collect(); // Empty collection for now since we don't have direct subject-teacher relationship
        $totalStudents = $classes->sum(function($class) {
            return $class->students()->count();
        });
        
        return view('modules.subjects.show', compact('subject', 'classes', 'teachers', 'totalStudents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('modules.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:subjects,code,' . $subject->id,
            'description' => 'nullable|string',
            'is_active' => 'required|in:0,1'
        ]);

        // Convert is_active to boolean
        $validated['is_active'] = (bool) $validated['is_active'];

        $subject->update($validated);

        return redirect()->route('subjects.index')
                        ->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        // Check if subject is assigned to any classes
        if ($subject->classes()->count() > 0) {
            return redirect()->route('subjects.index')
                            ->with('error', 'Cannot delete subject that is assigned to classes.');
        }

        $subject->delete();

        return redirect()->route('subjects.index')
                        ->with('success', 'Subject deleted successfully.');
    }
}
