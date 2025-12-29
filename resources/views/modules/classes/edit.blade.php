@extends('layouts.app')

@section('title', 'Edit Class')
@section('page-title', 'Edit Class')
@section('page-description', 'Update class information')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Edit Class: {{ $class->full_name ?? $class->name }}</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Update the class information below</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('classes.show', $class) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <i class="fas fa-eye mr-2"></i>
                    View Class
                </a>
                <a href="{{ route('classes.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Classes
                </a>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="p-6">
        <form data-spa-form method="POST" action="{{ route('classes.update', $class) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Class Level -->
                <div>
                    <label for="class_level_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Class Level <span class="text-red-500">*</span>
                    </label>
                    <select id="class_level_id" 
                            name="class_level_id"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-maroon/50 focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                            required>
                        <option value="">Select Class Level</option>
                        @foreach($classLevels ?? [] as $level)
                            <option value="{{ $level->id }}" {{ old('class_level_id', $class->class_level_id) == $level->id ? 'selected' : '' }}>
                                {{ $level->name }}
                                @if($level->schoolType)
                                    ({{ $level->schoolType->name }})
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('class_level_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stream -->
                <div>
                    <label for="stream_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Stream
                    </label>
                    <select id="stream_id" 
                            name="stream_id"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-maroon/50 focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Select Stream (Optional)</option>
                        @foreach($streams ?? [] as $stream)
                            <option value="{{ $stream->id }}" {{ old('stream_id', $class->stream_id) == $stream->id ? 'selected' : '' }}>
                                {{ $stream->name }}
                                @if($stream->description)
                                    ({{ $stream->description }})
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('stream_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Class Teacher -->
                <div>
                    <label for="class_teacher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Class Teacher
                    </label>
                    <select id="class_teacher_id" 
                            name="class_teacher_id"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-maroon/50 focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="">Select Class Teacher</option>
                        @foreach($teachers ?? [] as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('class_teacher_id', $class->class_teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->first_name }} {{ $teacher->last_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('class_teacher_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Class Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Class Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $class->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-maroon/50 focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                           placeholder="e.g., P1A, S2 Blue"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status
                    </label>
                    <select id="is_active" 
                            name="is_active"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-maroon/50 focus:border-maroon bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="1" {{ old('is_active', $class->is_active ?? true) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !old('is_active', $class->is_active ?? true) ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('is_active')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('classes.show', $class) }}" 
                   class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-maroon hover:bg-maroon-dark text-white rounded-lg transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Update Class
                </button>
            </div>
        </form>
    </div>
</div>
@endsection