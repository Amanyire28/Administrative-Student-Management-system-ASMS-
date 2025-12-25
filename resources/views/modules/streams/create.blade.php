@extends('layouts.app')

@section('title', 'Add Stream')
@section('page-title', 'Add New Stream')
@section('page-description', 'Create a new stream for classes')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Add New Stream</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Define a new stream for your classes</p>
            </div>
            <a href="{{ route('streams.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Streams
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="p-6">
        <form data-spa-form method="POST" action="{{ route('streams.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Stream Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-maroon/50 focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                           placeholder="e.g., A, B, Red, Lions"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Sort Order <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="sort_order" 
                           name="sort_order" 
                           value="{{ old('sort_order', 1) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-maroon/50 focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                           placeholder="1"
                           required>
                    @error('sort_order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        Lower numbers appear first in lists
                    </p>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Description
                </label>
                <input type="text" 
                       id="description" 
                       name="description" 
                       value="{{ old('description') }}"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-maroon/50 focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                       placeholder="Optional description for this stream">
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('streams.index') }}" 
                   class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-maroon hover:bg-maroon-dark text-white rounded-lg transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Create Stream
                </button>
            </div>
        </form>
    </div>
</div>
@endsection