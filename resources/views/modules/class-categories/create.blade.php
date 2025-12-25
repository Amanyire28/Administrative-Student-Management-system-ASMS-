@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Create Class Category</h1>
            <p class="text-gray-600">Add a new class category to your school system</p>
        </div>
        <a href="{{ route('class-categories.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
            Back to Categories
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('class-categories.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Category Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Category Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="e.g., Primary, Secondary, Advanced"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                        Sort Order <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="sort_order" 
                           name="sort_order" 
                           value="{{ old('sort_order', 1) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('sort_order') border-red-500 @enderror"
                           required>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                              placeholder="Optional description for this category">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('class-categories.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Create Category
                </button>
            </div>
        </form>
    </div>
</div>

@endsection