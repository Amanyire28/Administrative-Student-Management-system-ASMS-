<?php

namespace App\Http\Controllers;

use App\Models\ClassCategory;
use Illuminate\Http\Request;

class ClassCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ClassCategory::ordered()->paginate(15);
        return view('modules.class-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.class-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:class_categories',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'required|integer|min:0',
        ]);

        ClassCategory::create($validated);

        return redirect()->route('class-categories.index')
                        ->with('success', 'Class category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassCategory $classCategory)
    {
        return view('modules.class-categories.edit', compact('classCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassCategory $classCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:class_categories,name,' . $classCategory->id,
            'description' => 'nullable|string|max:500',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $classCategory->update($validated);

        return redirect()->route('class-categories.index')
                        ->with('success', 'Class category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassCategory $classCategory)
    {
        // Check if category has class levels
        if ($classCategory->classLevels()->count() > 0) {
            return redirect()->route('class-categories.index')
                            ->with('error', 'Cannot delete category with existing class levels.');
        }

        $classCategory->delete();

        return redirect()->route('class-categories.index')
                        ->with('success', 'Class category deleted successfully.');
    }
}