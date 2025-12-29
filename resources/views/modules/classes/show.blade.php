@extends('layouts.app')

@section('title', 'Class Details')
@section('page-title', $class->full_name ?? $class->name)
@section('page-description', 'Class information and management')

@section('content')
<div class="space-y-6">
    <!-- Class Information Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $class->full_name ?? $class->name }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Class Details and Management</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('classes.edit', $class) }}" 
                       class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Class
                    </a>
                    <a href="{{ route('classes.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Classes
                    </a>
                </div>
            </div>
        </div>

        <!-- Class Details -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Class Level -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-layer-group text-blue-600 dark:text-blue-400 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Class Level</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ $class->classLevel->name ?? 'N/A' }}
                            </p>
                            @if($class->classLevel && $class->classLevel->schoolType)
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $class->classLevel->schoolType->name }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Stream -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-stream text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Stream</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ $class->stream->name ?? 'No stream' }}
                            </p>
                            @if($class->stream && $class->stream->description)
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $class->stream->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Level Teacher -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-tie text-indigo-600 dark:text-indigo-400 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Level Teacher</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                @if($class->classLevel && $class->classLevel->levelTeacher)
                                    {{ $class->classLevel->levelTeacher->first_name }} {{ $class->classLevel->levelTeacher->last_name }}
                                @else
                                    <span class="text-gray-400 italic text-sm">Not assigned</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Class Teacher -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-chalkboard-teacher text-green-600 dark:text-green-400 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Class Teacher</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                @if($class->classTeacher)
                                    {{ $class->classTeacher->first_name }} {{ $class->classTeacher->last_name }}
                                @else
                                    <span class="text-gray-400 italic text-sm">Not assigned</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Current Students -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-graduate text-blue-600 dark:text-blue-400 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Enrolled</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ $class->students->count() ?? 0 }} students
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-toggle-{{ ($class->is_active ?? true) ? 'on' : 'off' }} text-{{ ($class->is_active ?? true) ? 'green' : 'red' }}-600 dark:text-{{ ($class->is_active ?? true) ? 'green' : 'red' }}-400 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Status</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                @if($class->is_active ?? true)
                                    <span class="text-green-600 dark:text-green-400">Active</span>
                                @else
                                    <span class="text-red-600 dark:text-red-400">Inactive</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Students in Class -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Students in {{ $class->full_name ?? $class->name }}
                </h3>
                <a href="{{ route('students.create') }}?class_id={{ $class->id }}" 
                   class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>
                    Add Student
                </a>
            </div>
        </div>

        <div class="p-6">
            @if($class->students && $class->students->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3">Student Name</th>
                                <th class="px-6 py-3">Student ID</th>
                                <th class="px-6 py-3">Gender</th>
                                <th class="px-6 py-3">Date of Birth</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($class->students as $student)
                            <tr class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                    {{ $student->first_name }} {{ $student->last_name }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                    {{ $student->student_id }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                    {{ ucfirst($student->gender ?? 'N/A') }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                    {{ $student->date_of_birth ? $student->date_of_birth->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('students.show', $student) }}" 
                                       class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300" 
                                       title="View Student">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-user-graduate text-4xl text-gray-400 dark:text-gray-600 mb-4"></i>
                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Students Enrolled</h4>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">This class doesn't have any students yet.</p>
                    <a href="{{ route('students.create') }}?class_id={{ $class->id }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>
                        Add First Student
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Subjects for Class -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Subjects for {{ $class->full_name ?? $class->name }}
                </h3>
                <button onclick="showAssignSubjectsModal()" 
                        class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <i class="fas fa-book mr-2"></i>
                    Assign Subjects
                </button>
            </div>
        </div>

        <div class="p-6">
            @if($class->subjects && $class->subjects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($class->subjects as $subject)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $subject->name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $subject->code }}</p>
                                @if($subject->pivot && $subject->pivot->teacher)
                                    <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                                        Teacher: {{ $subject->pivot->teacher->first_name }} {{ $subject->pivot->teacher->last_name }}
                                    </p>
                                @endif
                            </div>
                            <div class="text-right">
                                <a href="{{ route('subjects.show', $subject) }}" 
                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-xs">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-book text-4xl text-gray-400 dark:text-gray-600 mb-4"></i>
                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Subjects Assigned</h4>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">This class doesn't have any subjects assigned yet.</p>
                    <button onclick="showAssignSubjectsModal()" 
                            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-book mr-2"></i>
                        Assign First Subject
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Assign Subjects Modal (placeholder) -->
<script>
function showAssignSubjectsModal() {
    alert('Subject assignment feature will be implemented soon!');
}
</script>
@endsection