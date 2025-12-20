<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassModel::withCount('students')->paginate(15);
        return view('modules.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:classes',
            'level' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1|max:100',
            'classroom' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        ClassModel::create($validated);

        return redirect()->route('classes.index')
                        ->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassModel $class)
    {
        $class->load(['students', 'subjects.pivot.teacher', 'teachers']);
        return view('modules.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassModel $class)
    {
        return view('modules.classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassModel $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:classes,name,' . $class->id,
            'level' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1|max:100',
            'classroom' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $class->update($validated);

        return redirect()->route('classes.index')
                        ->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassModel $class)
    {
        // Check if class has students
        if ($class->students()->count() > 0) {
            return redirect()->route('classes.index')
                            ->with('error', 'Cannot delete class with enrolled students.');
        }

        $class->delete();

        return redirect()->route('classes.index')
                        ->with('success', 'Class deleted successfully.');
    }

    /**
     * Assign subjects to class
     */
    public function assignSubjects(Request $request, ClassModel $class)
    {
        $validated = $request->validate([
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
            'teachers' => 'array',
            'teachers.*' => 'nullable|exists:teachers,id'
        ]);

        $syncData = [];
        foreach ($validated['subjects'] as $index => $subjectId) {
            $syncData[$subjectId] = [
                'teacher_id' => $validated['teachers'][$index] ?? null
            ];
        }

        $class->subjects()->sync($syncData);

        return redirect()->route('classes.show', $class)
                        ->with('success', 'Subjects assigned successfully.');
    }
}
