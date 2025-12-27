@extends('layouts.app')

@section('title', 'Teacher Statistics')
@section('page-title', 'Teacher Statistics')
@section('page-description', 'Analytics and insights about teaching staff')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <div class="flex items-center space-x-4">
                    <div class="p-4 bg-gradient-to-r from-maroon/10 to-maroon/5 rounded-2xl">
                        <i class="fas fa-chart-bar text-maroon text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Teacher Statistics</h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Analytics and insights about teaching staff</p>
                    </div>
                </div>
            </div>

            <!-- Time Period Filter -->
            <div class="flex items-center space-x-3">
                <select id="timePeriod" class="px-4 py-2.5 border-2 border-gray-200 dark:border-gray-700 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-800 text-gray-900 dark:text-white transition-all duration-300">
                    <option value="current_year">Current Year</option>
                    <option value="last_year">Last Year</option>
                    <option value="last_quarter">Last Quarter</option>
                    <option value="all_time">All Time</option>
                </select>

                <a href="{{ route('teachers.index') }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 hover:from-gray-100 hover:to-gray-200 dark:hover:from-gray-600 dark:hover:to-gray-500 text-gray-700 dark:text-gray-300 font-semibold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Teachers
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Teachers -->
        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Teachers</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        {{ \App\Models\Teacher::count() }}
                    </p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600 dark:text-gray-400">Active</span>
                    <span class="font-semibold text-green-600 dark:text-green-400">
                        {{ \App\Models\Teacher::where('is_active', true)->count() }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Average Experience -->
        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Avg. Experience</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        @php
                            $avgExperience = \App\Models\Teacher::whereNotNull('employment_date')
                                ->avg(\DB::raw('YEAR(CURDATE()) - YEAR(employment_date)'));
                            echo round($avgExperience, 1) . ' yrs';
                        @endphp
                    </p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-white text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Based on {{ \App\Models\Teacher::whereNotNull('employment_date')->count() }} teachers
                </div>
            </div>
        </div>

        <!-- Class Coverage -->
        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Class Coverage</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        @php
                            $totalClasses = \App\Models\ClassModel::count();
                            $classesWithTeachers = \DB::table('class_teacher')->distinct('class_id')->count();
                            echo $totalClasses > 0 ? round(($classesWithTeachers / $totalClasses) * 100) . '%' : '0%';
                        @endphp
                    </p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $classesWithTeachers }} of {{ $totalClasses }} classes have teachers
                </div>
            </div>
        </div>

        <!-- Subject Coverage -->
        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Subject Coverage</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        @php
                            $totalSubjects = \App\Models\Subject::count();
                            $subjectsWithTeachers = \DB::table('teacher_subject')->distinct('subject_id')->count();
                            echo $totalSubjects > 0 ? round(($subjectsWithTeachers / $totalSubjects) * 100) . '%' : '0%';
                        @endphp
                    </p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-book text-white text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $subjectsWithTeachers }} of {{ $totalSubjects }} subjects have teachers
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Gender Distribution Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Gender Distribution</h3>
            </div>
            <div class="p-6">
                <div class="h-64 flex items-center justify-center">
                    @php
                        $maleCount = \App\Models\Teacher::where('gender', 'male')->count();
                        $femaleCount = \App\Models\Teacher::where('gender', 'female')->count();
                        $otherCount = \App\Models\Teacher::where('gender', 'other')->count();
                        $total = $maleCount + $femaleCount + $otherCount;
                    @endphp

                    @if($total > 0)
                    <div class="w-full max-w-md">
                        <!-- Chart -->
                        <div class="flex items-end h-40 mb-4">
                            <div class="flex-1 text-center">
                                <div class="h-{{ round(($maleCount/$total)*100) }} bg-gradient-to-t from-blue-500 to-blue-600 rounded-t-lg mx-auto" style="width: 80%;"></div>
                                <div class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ $maleCount }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Male</div>
                            </div>
                            <div class="flex-1 text-center">
                                <div class="h-{{ round(($femaleCount/$total)*100) }} bg-gradient-to-t from-pink-500 to-pink-600 rounded-t-lg mx-auto" style="width: 80%;"></div>
                                <div class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ $femaleCount }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Female</div>
                            </div>
                            <div class="flex-1 text-center">
                                <div class="h-{{ round(($otherCount/$total)*100) }} bg-gradient-to-t from-gray-500 to-gray-600 rounded-t-lg mx-auto" style="width: 80%;"></div>
                                <div class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ $otherCount }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Other</div>
                            </div>
                        </div>

                        <!-- Percentages -->
                        <div class="flex justify-between mt-6">
                            <div class="text-center">
                                <div class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ round(($maleCount/$total)*100) }}%</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Male</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-pink-600 dark:text-pink-400">{{ round(($femaleCount/$total)*100) }}%</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Female</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-gray-600 dark:text-gray-400">{{ round(($otherCount/$total)*100) }}%</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Other</div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-gray-400 dark:text-gray-500 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Data Available</h4>
                        <p class="text-gray-600 dark:text-gray-300">Add teachers to see gender distribution</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Experience Distribution -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Experience Distribution</h3>
            </div>
            <div class="p-6">
                <div class="h-64">
                    @php
                        $experienceRanges = [
                            '0-2' => \App\Models\Teacher::whereNotNull('employment_date')
                                ->whereRaw('YEAR(CURDATE()) - YEAR(employment_date) <= 2')
                                ->count(),
                            '3-5' => \App\Models\Teacher::whereNotNull('employment_date')
                                ->whereRaw('YEAR(CURDATE()) - YEAR(employment_date) BETWEEN 3 AND 5')
                                ->count(),
                            '6-10' => \App\Models\Teacher::whereNotNull('employment_date')
                                ->whereRaw('YEAR(CURDATE()) - YEAR(employment_date) BETWEEN 6 AND 10')
                                ->count(),
                            '10+' => \App\Models\Teacher::whereNotNull('employment_date')
                                ->whereRaw('YEAR(CURDATE()) - YEAR(employment_date) > 10')
                                ->count(),
                        ];
                        $totalWithExperience = array_sum($experienceRanges);
                    @endphp

                    @if($totalWithExperience > 0)
                    <div class="space-y-4">
                        @foreach($experienceRanges as $range => $count)
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $range }} years</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $count }}</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-green-500 to-green-600 h-2 rounded-full"
                                     style="width: {{ ($count/$totalWithExperience)*100 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="h-full flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-gray-400 dark:text-gray-500 text-2xl"></i>
                            </div>
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Experience Data</h4>
                            <p class="text-gray-600 dark:text-gray-300">Set employment dates for teachers</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Top Teachers by Assignments -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-maroon to-maroon-dark">
            <h3 class="text-lg font-semibold text-white">Top Teachers by Workload</h3>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Teacher</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Classes</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subjects</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Class Teacher</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Students</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Workload Score</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @php
                            $topTeachers = \App\Models\Teacher::withCount(['classes', 'subjects', 'classTeacherOf'])
                                ->with(['classes' => function($query) {
                                    $query->withCount('students');
                                }])
                                ->orderByDesc('classes_count')
                                ->limit(10)
                                ->get()
                                ->map(function($teacher) {
                                    $totalStudents = $teacher->classes->sum('students_count');
                                    $workloadScore = ($teacher->classes_count * 2) + ($teacher->subjects_count * 1.5) + ($teacher->classTeacherOf_count * 3);
                                    $teacher->total_students = $totalStudents;
                                    $teacher->workload_score = round($workloadScore, 1);
                                    return $teacher;
                                })
                                ->sortByDesc('workload_score');
                        @endphp

                        @forelse($topTeachers as $teacher)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    @if($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->full_name }}"
                                         class="w-8 h-8 rounded-lg object-cover mr-3">
                                    @else
                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white text-xs font-bold mr-3">
                                        {{ substr($teacher->first_name, 0, 1) }}{{ substr($teacher->last_name, 0, 1) }}
                                    </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-gray-900 dark:text-white">{{ $teacher->full_name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $teacher->employee_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $teacher->classes_count }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $teacher->subjects_count }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $teacher->classTeacherOf_count }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $teacher->total_students }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2 mr-3">
                                        <div class="bg-gradient-to-r from-{{ $teacher->workload_score > 15 ? 'red' : ($teacher->workload_score > 10 ? 'yellow' : 'green') }}-500 to-{{ $teacher->workload_score > 15 ? 'red' : ($teacher->workload_score > 10 ? 'yellow' : 'green') }}-600 h-2 rounded-full"
                                             style="width: {{ min(100, ($teacher->workload_score / 20) * 100) }}%"></div>
                                    </div>
                                    <span class="font-bold text-gray-900 dark:text-white">{{ $teacher->workload_score }}</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center">
                                <div class="w-16 h-16 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-chart-bar text-gray-400 dark:text-gray-500 text-2xl"></i>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Data Available</h4>
                                <p class="text-gray-600 dark:text-gray-300">Assign classes and subjects to teachers</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Teachers without Assignments -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-yellow-500 to-yellow-600">
            <h3 class="text-lg font-semibold text-white">Teachers Needing Assignments</h3>
        </div>
        <div class="p-6">
            @php
                $unassignedTeachers = \App\Models\Teacher::withCount(['classes', 'subjects'])
                    ->having('classes_count', 0)
                    ->orHaving('subjects_count', 0)
                    ->get()
                    ->filter(function($teacher) {
                        return $teacher->classes_count == 0 || $teacher->subjects_count == 0;
                    });
            @endphp

            @if($unassignedTeachers->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($unassignedTeachers as $teacher)
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-xl p-4 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            @if($teacher->photo)
                            <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->full_name }}"
                                 class="w-10 h-10 rounded-lg object-cover mr-3">
                            @else
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white text-sm font-bold mr-3">
                                {{ substr($teacher->first_name, 0, 1) }}{{ substr($teacher->last_name, 0, 1) }}
                            </div>
                            @endif
                            <div>
                                <div class="font-medium text-gray-900 dark:text-white">{{ $teacher->full_name }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $teacher->employee_id }}</div>
                            </div>
                        </div>
                        <a href="{{ route('teachers.edit', $teacher) }}" class="text-maroon dark:text-maroon-light hover:text-maroon-dark dark:hover:text-maroon-lighter">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600 dark:text-gray-400">Classes:</span>
                        <span class="font-semibold {{ $teacher->classes_count == 0 ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}">
                            {{ $teacher->classes_count }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between text-sm mt-2">
                        <span class="text-gray-600 dark:text-gray-400">Subjects:</span>
                        <span class="font-semibold {{ $teacher->subjects_count == 0 ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}">
                            {{ $teacher->subjects_count }}
                        </span>
                    </div>

                    <div class="mt-3 pt-3 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('teachers.edit', $teacher) }}" class="block text-center px-3 py-2 bg-gradient-to-r from-maroon to-maroon-dark text-white text-xs font-semibold rounded-lg transition-all duration-300 hover:shadow-md">
                            Assign Now
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <div class="w-16 h-16 bg-gradient-to-r from-green-100 to-green-200 dark:from-green-900/30 dark:to-green-800/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-2xl"></i>
                </div>
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">All Teachers Assigned</h4>
                <p class="text-gray-600 dark:text-gray-300">Great! All teachers have classes or subjects assigned.</p>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Time period filter
    document.getElementById('timePeriod')?.addEventListener('change', function() {
        showNotification('Loading statistics for ' + this.options[this.selectedIndex].text + '...', 'info');
        // In a real implementation, you would fetch new data based on the selected period
        // For now, we'll just show a notification
    });

    // Notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        const colors = {
            'success': 'from-green-500 to-green-600',
            'error': 'from-red-500 to-red-600',
            'info': 'from-blue-500 to-blue-600',
            'warning': 'from-yellow-500 to-yellow-600'
        };

        notification.className = `fixed top-6 right-6 bg-gradient-to-r ${colors[type]} text-white px-6 py-4 rounded-xl shadow-2xl z-50 animate-slideIn`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'} text-xl mr-3"></i>
                <div>
                    <p class="font-semibold">${message}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-6 text-white/80 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 5000);
    }
</script>
@endpush

<style>
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .animate-slideIn {
        animation: slideIn 0.3s ease-out;
    }

    /* Smooth transitions for cards */
    .bg-gradient-to-br {
        transition: all 0.3s ease;
    }

    .bg-gradient-to-br:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .dark .bg-gradient-to-br:hover {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
    }

    /* Custom scrollbar for tables */
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }

    .dark .overflow-x-auto::-webkit-scrollbar-track {
        background: #374151;
    }

    .dark .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #6b7280;
    }
</style>
@endsection
