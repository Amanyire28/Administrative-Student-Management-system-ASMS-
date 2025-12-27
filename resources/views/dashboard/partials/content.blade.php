{{-- resources/views/dashboard/partials/content.blade.php --}}
{{-- Final working version with only existing models --}}

<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                    Welcome, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    Academic School Management System Dashboard
                </p>
            </div>
            <div class="hidden md:block">
                <div class="text-right">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Current Date</p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        {{ now()->format('F d, Y') }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ now()->format('l') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Students Card - Show only if user can view students -->
        @canany(['students.view', 'students.view-detail'])
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200 cursor-pointer"
             onclick="window.location.href='{{ route('students.index') }}'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Students</p>
                    <p class="text-4xl font-bold mt-2">
                        {{ \App\Models\Student::count() }}
                    </p>
                    <p class="text-blue-100 text-xs mt-2">
                        <i class="fas fa-arrow-up mr-1"></i>
                        {{ \App\Models\Student::whereDate('created_at', today())->count() }} new today
                    </p>
                </div>
                <div class="bg-white bg-opacity-20 p-4 rounded-full">
                    <i class="fas fa-users text-4xl"></i>
                </div>
            </div>
        </div>
        @endcanany

        <!-- Teachers Card - Show only if user can view teachers -->
        @canany(['teachers.view', 'teachers.view-detail'])
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200 cursor-pointer"
             onclick="window.location.href='{{ route('teachers.index') }}'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Teachers</p>
                    <p class="text-4xl font-bold mt-2">
                        {{ \App\Models\Teacher::count() }}
                    </p>
                    <p class="text-green-100 text-xs mt-2">
                        <i class="fas fa-check-circle mr-1"></i>
                        Active staff members
                    </p>
                </div>
                <div class="bg-white bg-opacity-20 p-4 rounded-full">
                    <i class="fas fa-chalkboard-teacher text-4xl"></i>
                </div>
            </div>
        </div>
        @endcanany

        <!-- Subjects Card - Show only if user can view subjects -->
        @canany(['subjects.view', 'subjects.view-detail'])
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200 cursor-pointer"
             onclick="window.location.href='{{ route('subjects.index') }}'">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Total Subjects</p>
                    <p class="text-4xl font-bold mt-2">
                        {{ \App\Models\Subject::count() }}
                    </p>
                    <p class="text-purple-100 text-xs mt-2">
                        <i class="fas fa-book-open mr-1"></i>
                        Course curriculum
                    </p>
                </div>
                <div class="bg-white bg-opacity-20 p-4 rounded-full">
                    <i class="fas fa-book text-4xl"></i>
                </div>
            </div>
        </div>
        @endcanany
    </div>

    <!-- Quick Actions Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                <i class="fas fa-bolt text-yellow-500 mr-2"></i>Quick Actions
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Add Student - Show only if user can create students -->
            @can('students.create')
            <a href="{{ route('students.create') }}"
               hx-get="{{ route('students.create') }}"
               hx-target="#page-content"
               hx-push-url="true"
               hx-indicator="#loading-indicator"
               class="group flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-lg hover:shadow-lg transition-all duration-200 border-2 border-transparent hover:border-blue-300 dark:hover:border-blue-700">
                <div class="p-3 bg-blue-500 text-white rounded-lg group-hover:scale-110 transition-transform shadow-md">
                    <i class="fas fa-user-plus text-2xl"></i>
                </div>
                <div class="ml-4 flex-1">
                    <p class="font-bold text-gray-800 dark:text-gray-100 text-lg">Add Student</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Register new student</p>
                </div>
                <i class="fas fa-arrow-right text-blue-500 group-hover:translate-x-2 transition-transform"></i>
            </a>
            @endcan

            <!-- View All Students - Show only if user can view students -->
            @canany(['students.view', 'students.view-detail'])
            <a href="{{ route('students.index') }}"
               hx-get="{{ route('students.index') }}"
               hx-target="#page-content"
               hx-push-url="true"
               hx-indicator="#loading-indicator"
               class="group flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-lg hover:shadow-lg transition-all duration-200 border-2 border-transparent hover:border-green-300 dark:hover:border-green-700">
                <div class="p-3 bg-green-500 text-white rounded-lg group-hover:scale-110 transition-transform shadow-md">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div class="ml-4 flex-1">
                    <p class="font-bold text-gray-800 dark:text-gray-100 text-lg">View Students</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Manage all students</p>
                </div>
                <i class="fas fa-arrow-right text-green-500 group-hover:translate-x-2 transition-transform"></i>
            </a>
            @endcanany

            <!-- Add Teacher - Show only if user can create teachers -->
            @can('teachers.create')
            <a href="{{ route('teachers.create') }}"
               hx-get="{{ route('teachers.create') }}"
               hx-target="#page-content"
               hx-push-url="true"
               hx-indicator="#loading-indicator"
               class="group flex items-center p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/20 rounded-lg hover:shadow-lg transition-all duration-200 border-2 border-transparent hover:border-yellow-300 dark:hover:border-yellow-700">
                <div class="p-3 bg-yellow-500 text-white rounded-lg group-hover:scale-110 transition-transform shadow-md">
                    <i class="fas fa-user-tie text-2xl"></i>
                </div>
                <div class="ml-4 flex-1">
                    <p class="font-bold text-gray-800 dark:text-gray-100 text-lg">Add Teacher</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Register new teacher</p>
                </div>
                <i class="fas fa-arrow-right text-yellow-500 group-hover:translate-x-2 transition-transform"></i>
            </a>
            @endcan

            <!-- View Teachers - Show only if user can view teachers -->
            @canany(['teachers.view', 'teachers.view-detail'])
            <a href="{{ route('teachers.index') }}"
               hx-get="{{ route('teachers.index') }}"
               hx-target="#page-content"
               hx-push-url="true"
               hx-indicator="#loading-indicator"
               class="group flex items-center p-4 bg-gradient-to-r from-indigo-50 to-indigo-100 dark:from-indigo-900/20 dark:to-indigo-800/20 rounded-lg hover:shadow-lg transition-all duration-200 border-2 border-transparent hover:border-indigo-300 dark:hover:border-indigo-700">
                <div class="p-3 bg-indigo-500 text-white rounded-lg group-hover:scale-110 transition-transform shadow-md">
                    <i class="fas fa-chalkboard-teacher text-2xl"></i>
                </div>
                <div class="ml-4 flex-1">
                    <p class="font-bold text-gray-800 dark:text-gray-100 text-lg">View Teachers</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Manage teaching staff</p>
                </div>
                <i class="fas fa-arrow-right text-indigo-500 group-hover:translate-x-2 transition-transform"></i>
            </a>
            @endcanany

            <!-- Manage Subjects - Show only if user can view subjects -->
            @canany(['subjects.view', 'subjects.view-detail'])
            <a href="{{ route('subjects.index') }}"
               hx-get="{{ route('subjects.index') }}"
               hx-target="#page-content"
               hx-push-url="true"
               hx-indicator="#loading-indicator"
               class="group flex items-center p-4 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-lg hover:shadow-lg transition-all duration-200 border-2 border-transparent hover:border-purple-300 dark:hover:border-purple-700">
                <div class="p-3 bg-purple-500 text-white rounded-lg group-hover:scale-110 transition-transform shadow-md">
                    <i class="fas fa-book text-2xl"></i>
                </div>
                <div class="ml-4 flex-1">
                    <p class="font-bold text-gray-800 dark:text-gray-100 text-lg">Manage Subjects</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Course curriculum</p>
                </div>
                <i class="fas fa-arrow-right text-purple-500 group-hover:translate-x-2 transition-transform"></i>
            </a>
            @endcanany

            <!-- Enter Marks - Show only if user can enter marks -->
            @can('marks.entry')
            <a href="{{ route('marks.entry.form') }}"
               hx-get="{{ route('marks.entry.form') }}"
               hx-target="#page-content"
               hx-push-url="true"
               hx-indicator="#loading-indicator"
               class="group flex items-center p-4 bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 rounded-lg hover:shadow-lg transition-all duration-200 border-2 border-transparent hover:border-red-300 dark:hover:border-red-700">
                <div class="p-3 bg-red-500 text-white rounded-lg group-hover:scale-110 transition-transform shadow-md">
                    <i class="fas fa-edit text-2xl"></i>
                </div>
                <div class="ml-4 flex-1">
                    <p class="font-bold text-gray-800 dark:text-gray-100 text-lg">Enter Marks</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Record student marks</p>
                </div>
                <i class="fas fa-arrow-right text-red-500 group-hover:translate-x-2 transition-transform"></i>
            </a>
            @endcan
        </div>

        <!-- If user has no quick action permissions -->
        @cannot(['students.create', 'students.view', 'students.view-detail', 'teachers.create', 'teachers.view', 'teachers.view-detail', 'subjects.view', 'subjects.view-detail', 'marks.entry'])
        <div class="text-center py-8">
            <div class="inline-block p-6 bg-gray-100 dark:bg-gray-900 rounded-full mb-4">
                <i class="fas fa-lock text-gray-300 dark:text-gray-600 text-5xl"></i>
            </div>
            <p class="text-gray-500 dark:text-gray-400 text-lg">No quick actions available for your role</p>
            <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">Contact administrator for access permissions</p>
        </div>
        @endcannot
    </div>

    <!-- Recent Students Activity - Show only if user can view students -->
    @canany(['students.view', 'students.view-detail'])
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                <i class="fas fa-history text-blue-500 mr-2"></i>Recent Students
            </h2>
            @canany(['students.view', 'students.view-detail'])
            <a href="{{ route('students.index') }}"
               hx-get="{{ route('students.index') }}"
               hx-target="#page-content"
               hx-push-url="true"
               class="text-blue-600 hover:text-blue-700 dark:text-blue-400 text-sm font-medium">
                View All →
            </a>
            @endcanany
        </div>

        <div class="space-y-3">
            @php
                $recentStudents = \App\Models\Student::latest()->take(5)->get();
            @endphp

            @forelse($recentStudents as $student)
            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-lg">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </span>
                    </div>
                    <div class="ml-4">
                        <p class="font-semibold text-gray-800 dark:text-gray-100">
                            {{ $student->name }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            <i class="fas fa-clock text-xs mr-1"></i>
                            Registered {{ $student->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-xs px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded-full font-medium">
                        Active
                    </span>
                    <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <div class="inline-block p-6 bg-gray-100 dark:bg-gray-900 rounded-full mb-4">
                    <i class="fas fa-user-graduate text-gray-300 dark:text-gray-600 text-5xl"></i>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-lg">No students registered yet</p>
                @can('students.create')
                <a href="{{ route('students.create') }}"
                   hx-get="{{ route('students.create') }}"
                   hx-target="#page-content"
                   hx-push-url="true"
                   class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Add First Student
                </a>
                @endcan
            </div>
            @endforelse
        </div>
    </div>
    @endcanany

    <!-- System Status (Optional) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">System Status</p>
                    <p class="text-lg font-bold text-gray-800 dark:text-gray-100">Operational</p>
                </div>
                <i class="fas fa-check-circle text-green-500 text-2xl"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Database</p>
                    <p class="text-lg font-bold text-gray-800 dark:text-gray-100">Connected</p>
                </div>
                <i class="fas fa-database text-blue-500 text-2xl"></i>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Server Time</p>
                    <p class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ now()->format('H:i') }}</p>
                </div>
                <i class="fas fa-clock text-purple-500 text-2xl"></i>
            </div>
        </div>
    </div>
</div>
