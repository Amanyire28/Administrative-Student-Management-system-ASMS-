<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassLevel;
use App\Models\Stream;
use App\Models\ClassStream;
use App\Models\Teacher;
use App\Models\SchoolType;

class ClassController extends Controller
{
    /**
     * Display a listing of classes
     */
    public function index()
    {
        // Load existing class structure grouped by school type
        $classLevels = ClassLevel::with([
            'classStreams.stream',
            'classStreams.students',
            'schoolType'
        ])
        ->orderBy('school_type_id')
        ->orderBy('sort_order')
        ->get();
        
        // Get all class streams for the table
        $classStreams = ClassStream::with([
            'classLevel.schoolType',
            'stream',
            'students'
        ])
        ->orderBy('name')
        ->get();
        
        // Group class levels by school type for display
        $categories = $classLevels->groupBy('school_type_id')->map(function ($levels, $schoolTypeId) {
            $schoolType = $levels->first()->schoolType;
            return (object) [
                'name' => $schoolType ? $schoolType->name : 'Unknown',
                'classLevels' => $levels
            ];
        });
            
        $totalClassLevels = ClassLevel::count();
        $totalStreams = Stream::count();
        $totalClassStreams = ClassStream::count();
        
        return view('modules.classes.index', compact(
            'categories', 
            'classStreams',
            'totalClassLevels', 
            'totalStreams', 
            'totalClassStreams'
        ));
    }
    
    /**
     * Show the class setup wizard
     */
    public function setupWizard()
    {
        return view('modules.classes.setup-wizard');
    }
    
    /**
     * Show the form for creating a new class
     */
    public function create()
    {
        $classLevels = ClassLevel::with('schoolType')->where('is_active', true)->orderBy('sort_order')->get();
        $streams = Stream::where('is_active', true)->orderBy('sort_order')->get();
        $teachers = Teacher::where('is_active', true)->orderBy('first_name')->get();
        
        return view('modules.classes.create', compact('classLevels', 'streams', 'teachers'));
    }
    
    /**
     * Store a newly created class in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_level_name' => 'required|string|max:255',
            'school_type_name' => 'required|string|max:255',
            'stream_name' => 'nullable|string|max:255',
            'name' => 'required|string|max:255|unique:class_streams,name',
            'class_teacher_id' => 'nullable|exists:teachers,id',
        ]);
        
        // Find or create school type
        $schoolType = SchoolType::firstOrCreate([
            'name' => $request->school_type_name
        ], [
            'description' => 'Custom school type',
            'default_classes' => [],
            'sort_order' => SchoolType::max('sort_order') + 1 ?? 1,
            'is_active' => true
        ]);
        
        // Find or create class level
        $classLevel = ClassLevel::firstOrCreate([
            'name' => $request->class_level_name,
            'school_type_id' => $schoolType->id
        ], [
            'sort_order' => ClassLevel::where('school_type_id', $schoolType->id)->max('sort_order') + 1 ?? 1,
            'is_active' => true
        ]);
        
        // Find or create stream if provided
        $stream = null;
        if ($request->filled('stream_name')) {
            $stream = Stream::firstOrCreate([
                'name' => $request->stream_name
            ], [
                'description' => 'Custom stream',
                'sort_order' => Stream::max('sort_order') + 1 ?? 1,
                'is_active' => true
            ]);
        }
        
        // Create class stream
        ClassStream::create([
            'class_level_id' => $classLevel->id,
            'stream_id' => $stream ? $stream->id : null,
            'name' => $request->name,
            'class_teacher_id' => $request->class_teacher_id,
            'is_active' => true,
        ]);
        
        return redirect()->route('classes.index')
            ->with('success', 'Class created successfully!');
    }
    
    /**
     * Display the specified class
     */
    public function show(ClassStream $class)
    {
        $class->load(['classLevel', 'stream', 'students', 'subjects']);
        
        return view('modules.classes.show', compact('class'));
    }
    
    /**
     * Show the form for editing the specified class
     */
    public function edit(ClassStream $class)
    {
        $classLevels = ClassLevel::with('schoolType')->where('is_active', true)->orderBy('sort_order')->get();
        $streams = Stream::where('is_active', true)->orderBy('sort_order')->get();
        $teachers = Teacher::where('is_active', true)->orderBy('first_name')->get();
        
        return view('modules.classes.edit', compact('class', 'classLevels', 'streams', 'teachers'));
    }
    
    /**
     * Update the specified class in storage
     */
    public function update(Request $request, ClassStream $class)
    {
        $request->validate([
            'class_level_id' => 'required|exists:class_levels,id',
            'stream_id' => 'nullable|exists:streams,id',
            'name' => 'required|string|max:255|unique:class_streams,name,' . $class->id,
            'class_teacher_id' => 'nullable|exists:teachers,id',
            'is_active' => 'boolean',
        ]);
        
        $class->update([
            'class_level_id' => $request->class_level_id,
            'stream_id' => $request->stream_id,
            'name' => $request->name,
            'class_teacher_id' => $request->class_teacher_id,
            'is_active' => $request->has('is_active'),
        ]);
        
        return redirect()->route('classes.index')
            ->with('success', 'Class updated successfully!');
    }
    
    /**
     * Remove the specified class from storage
     */
    public function destroy(ClassStream $class)
    {
        // Check if class has students
        if ($class->students()->count() > 0) {
            return redirect()->route('classes.index')
                ->with('error', 'Cannot delete class that has students enrolled.');
        }
        
        $class->delete();
        
        return redirect()->route('classes.index')
            ->with('success', 'Class deleted successfully!');
    }
    
    /**
     * Clear all class data (for testing)
     */
    public function clearAll()
    {
        ClassStream::truncate();
        ClassLevel::truncate();
        Stream::truncate();
        
        return redirect()->route('classes.index')
            ->with('success', 'All class data cleared successfully!');
    }
}