<?php

namespace App\Http\Controllers;

use App\Models\ClassLevel;
use App\Models\ClassCategory;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $classLevels = ClassLevel::orderBy('sort_order')->orderBy('name')->paginate(15);
            return view('modules.class-levels.index', compact('classLevels'));
        } catch (\Exception $e) {
            // If there's an error, return empty paginated collection
            $classLevels = new \Illuminate\Pagination\LengthAwarePaginator(
                collect([]), // Empty collection
                0, // Total items
                15, // Per page
                1, // Current page
                ['path' => request()->url()] // Options
            );
            return view('modules.class-levels.index', compact('classLevels'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ClassCategory::active()->ordered()->get();
        $teachers = Teacher::orderBy('first_name')->get();
        return view('modules.class-levels.create', compact('categories', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:class_levels',
            'category_id' => 'required|exists:class_categories,id',
            'sort_order' => 'required|integer|min:0',
            'level_teacher_id' => 'nullable|exists:teachers,id',
        ]);

        ClassLevel::create($validated);

        return redirect()->route('class-levels.index')
                        ->with('success', 'Class level created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassLevel $classLevel)
    {
        $categories = ClassCategory::active()->ordered()->get();
        $teachers = Teacher::orderBy('first_name')->get();
        return view('modules.class-levels.edit', compact('classLevel', 'categories', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassLevel $classLevel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:class_levels,name,' . $classLevel->id,
            'category_id' => 'required|exists:class_categories,id',
            'sort_order' => 'required|integer|min:0',
            'level_teacher_id' => 'nullable|exists:teachers,id',
            'is_active' => 'boolean'
        ]);

        $classLevel->update($validated);

        return redirect()->route('class-levels.index')
                        ->with('success', 'Class level updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassLevel $classLevel)
    {
        // Check if class level has classes
        if ($classLevel->classes()->count() > 0) {
            return redirect()->route('class-levels.index')
                            ->with('error', 'Cannot delete class level with existing classes.');
        }

        $classLevel->delete();

        return redirect()->route('class-levels.index')
                        ->with('success', 'Class level deleted successfully.');
    }
}