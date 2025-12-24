@extends('layouts.app')

@section('title', 'Classes')
@section('page-title', 'Classes')
@section('page-description', 'Manage school classes and their details')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Classes Management</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage school classes and their information</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('classes.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-maroon hover:bg-maroon-dark text-white text-sm font-medium rounded-lg transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Add Class
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Navigation -->
    <div class="p-6 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Class Management Tools</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <a href="{{ route('class-categories.index') }}" 
               class="flex items-center p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                <div class="flex-shrink-0">
                    <i class="fas fa-tags text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Categories</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Manage class categories</p>
                </div>
            </a>

            <a href="{{ route('class-levels.index') }}" 
               class="flex items-center p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                <div class="flex-shrink-0">
                    <i class="fas fa-layer-group text-green-600 dark:text-green-400 group-hover:text-green-700 dark:group-hover:text-green-300"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Class Levels</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Define class levels</p>
                </div>
            </a>

            <a href="{{ route('streams.index') }}" 
               class="flex items-center p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                <div class="flex-shrink-0">
                    <i class="fas fa-stream text-purple-600 dark:text-purple-400 group-hover:text-purple-700 dark:group-hover:text-purple-300"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Streams</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Manage class streams</p>
                </div>
            </a>

            <a href="{{ route('teachers.index') }}" 
               class="flex items-center p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                <div class="flex-shrink-0">
                    <i class="fas fa-chalkboard-teacher text-orange-600 dark:text-orange-400 group-hover:text-orange-700 dark:group-hover:text-orange-300"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Teachers</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Assign class teachers</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="p-6">
        @if($classes->count() > 0)
            <!-- Classes Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3">Class</th>
                            <th class="px-6 py-3">Stream</th>
                            <th class="px-6 py-3">Class Teacher</th>
                            <th class="px-6 py-3">Capacity</th>
                            <th class="px-6 py-3">Students</th>
                            <th class="px-6 py-3">Classroom</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $class)
                        <tr class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                {{ $class->classLevel->name }}
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                    {{ $class->stream->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                @if($class->classTeacher)
                                    {{ $class->classTeacher->first_name }} {{ $class->classTeacher->last_name }}
                                @else
                                    <span class="text-gray-400 italic">Not assigned</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                {{ $class->capacity }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                    {{ $class->students_count }} students
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                {{ $class->classroom ?? 'Not assigned' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($class->is_active ?? true)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('classes.show', $class) }}" 
                                       class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300" 
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('classes.edit', $class) }}" 
                                       class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-300" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('classes.destroy', $class) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this class?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300" 
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $classes->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <i class="fas fa-chalkboard text-6xl text-gray-400 dark:text-gray-600 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Classes Found</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Before creating classes, make sure you have set up class levels and streams.</p>
                
                <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
                    <a href="{{ route('class-levels.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-layer-group mr-2"></i>
                        Setup Class Levels
                    </a>
                    <a href="{{ route('streams.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-stream mr-2"></i>
                        Setup Streams
                    </a>
                    <a href="{{ route('classes.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-maroon hover:bg-maroon-dark text-white text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Create Class
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection