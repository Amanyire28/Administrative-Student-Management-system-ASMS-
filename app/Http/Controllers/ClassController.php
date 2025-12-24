<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\ClassLevel;
use App\Models\Stream;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassModel::with(['classTeacher', 'classLevel', 'stream'])->withCount('students')->paginate(15);
        return view('modules.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::orderBy('first_name')->get();
        $classLevels = ClassLevel::with('category')->active()->ordered()->get();
        $streams = Stream::active()->ordered()->get();
        
        return view('modules.classes.create', compact('teachers', 'classLevels', 'streams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_level_id' => 'required|exists:class_levels,id',
            'stream_id' => 'required|exists:streams,id',
            'capacity' => 'required|integer|min:1|max:100',
            'classroom' => 'nullable|string|max:255',
            'class_teacher_id' => 'nullable|exists:teachers,id'
        ]);

        // Generate name from class_level and stream
        $classLevel = ClassLevel::find($validated['class_level_id']);
        $stream = Stream::find($validated['stream_id']);
        $validated['name'] = $classLevel->name . ' ' . $stream->name;

        ClassModel::create($validated);

        return redirect()->route('classes.index')
                        ->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassModel $class)
    {
        $class->load(['students', 'subjects.pivot.teacher', 'teachers', 'classTeacher']);
        return view('modules.classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassModel $class)
    {
        $teachers = Teacher::orderBy('first_name')->get();
        $classLevels = ClassLevel::with('category')->active()->ordered()->get();
        $streams = Stream::active()->ordered()->get();
        
        return view('modules.classes.edit', compact('class', 'teachers', 'classLevels', 'streams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassModel $class)
    {
        $validated = $request->validate([
            'class_level_id' => 'required|exists:class_levels,id',
            'stream_id' => 'required|exists:streams,id',
            'capacity' => 'required|integer|min:1|max:100',
            'classroom' => 'nullable|string|max:255',
            'class_teacher_id' => 'nullable|exists:teachers,id',
            'is_active' => 'boolean'
        ]);

        // Generate name from class_level and stream
        $classLevel = ClassLevel::find($validated['class_level_id']);
        $stream = Stream::find($validated['stream_id']);
        $validated['name'] = $classLevel->name . ' ' . $stream->name;

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
