<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $streams = Stream::ordered()->paginate(15);
        return view('modules.streams.index', compact('streams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.streams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:streams',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'required|integer|min:0',
        ]);

        Stream::create($validated);

        return redirect()->route('streams.index')
                        ->with('success', 'Stream created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stream $stream)
    {
        return view('modules.streams.edit', compact('stream'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stream $stream)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:streams,name,' . $stream->id,
            'description' => 'nullable|string|max:500',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $stream->update($validated);

        return redirect()->route('streams.index')
                        ->with('success', 'Stream updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stream $stream)
    {
        // Check if stream has classes
        if ($stream->classes()->count() > 0) {
            return redirect()->route('streams.index')
                            ->with('error', 'Cannot delete stream with existing classes.');
        }

        $stream->delete();

        return redirect()->route('streams.index')
                        ->with('success', 'Stream deleted successfully.');
    }
}