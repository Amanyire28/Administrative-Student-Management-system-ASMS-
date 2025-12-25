@extends('layouts.app')

@section('title', 'Teachers Management')
@section('page-title', 'Teachers Management')
@section('page-description', 'View and manage all teachers')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <div class="flex items-center space-x-4">
                    <div class="p-4 bg-gradient-to-r from-maroon/10 to-maroon/5 rounded-2xl">
                        <i class="fas fa-chalkboard-teacher text-maroon text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Teachers Management</h1>
                        <div class="flex items-center space-x-4 mt-2">
                            <p class="text-gray-600 dark:text-gray-300">Manage all teacher records, assignments, and profiles</p>
                            <span class="px-3 py-1 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/10 text-green-700 dark:text-green-400 text-xs font-semibold rounded-full">
                                <i class="fas fa-users mr-1"></i>
                                <span id="totalTeachers">24</span> Teachers
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="flex items-center space-x-3">
                <a href="/admin/teachers/create?demo=true"
                   class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-maroon to-maroon-dark hover:from-maroon-dark hover:to-maroon text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
                    <i class="fas fa-user-plus mr-2"></i>
                    Add New Teacher
                </a>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="inline-flex items-center px-4 py-3 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 hover:from-gray-100 hover:to-gray-200 dark:hover:from-gray-600 dark:hover:to-gray-500 text-gray-700 dark:text-gray-300 font-semibold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
                        <i class="fas fa-ellipsis-v mr-2"></i>
                        More Actions
                    </button>

                    <div x-show="open"
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-2"
                        class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700 py-2 z-50"
                        style="display: none;">
                        <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200">
                            <i class="fas fa-file-export text-blue-600 dark:text-blue-400 w-5 mr-3"></i>
                            <span class="text-gray-900 dark:text-gray-100">Export to Excel</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200">
                            <i class="fas fa-print text-green-600 dark:text-green-400 w-5 mr-3"></i>
                            <span class="text-gray-900 dark:text-gray-100">Print List</span>
                        </a>
                        <div class="border-t border-gray-100 dark:border-gray-700 my-2"></div>
                        <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200">
                            <i class="fas fa-cog text-gray-600 dark:text-gray-400 w-5 mr-3"></i>
                            <span class="text-gray-900 dark:text-gray-100">Manage Departments</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Teachers -->
        <div class="bg-gradient-to-r from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Teachers</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">24</p>
                </div>
                <div class="p-3 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/10 rounded-xl">
                    <i class="fas fa-users text-blue-600 dark:text-blue-400 text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-600 dark:text-green-400 font-semibold">
                    <i class="fas fa-arrow-up mr-1"></i>
                    12%
                </span>
                <span class="text-gray-500 dark:text-gray-400 ml-2">from last month</span>
            </div>
        </div>

        <!-- Active Teachers -->
        <div class="bg-gradient-to-r from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Teachers</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">22</p>
                </div>
                <div class="p-3 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/10 rounded-xl">
                    <i class="fas fa-user-check text-green-600 dark:text-green-400 text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">2 on leave</span>
                    <span class="text-green-600 dark:text-green-400 font-semibold">92% Active</span>
                </div>
            </div>
        </div>

        <!-- Department Distribution -->
        <div class="bg-gradient-to-r from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Departments</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">6</p>
                </div>
                <div class="p-3 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/10 rounded-xl">
                    <i class="fas fa-sitemap text-purple-600 dark:text-purple-400 text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                Science: 8, Math: 4, Languages: 6
            </div>
        </div>

        <!-- Average Experience -->
        <div class="bg-gradient-to-r from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Avg. Experience</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">7.5 yrs</p>
                </div>
                <div class="p-3 bg-gradient-to-r from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/10 rounded-xl">
                    <i class="fas fa-award text-orange-600 dark:text-orange-400 text-2xl"></i>
                </div>
            </div>
            <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                <i class="fas fa-graduation-cap mr-1"></i>
                85% have Masters
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex-1">
                    <div class="relative max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 dark:text-gray-500"></i>
                        </div>
                        <input type="text"
                               id="teacherSearch"
                               class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all duration-300"
                               placeholder="Search teachers by name, ID, or department..."
                               onkeyup="filterTeachers()">
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <!-- Filter Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 hover:from-gray-100 hover:to-gray-200 dark:hover:from-gray-600 dark:hover:to-gray-500 text-gray-700 dark:text-gray-300 font-medium rounded-xl transition-all duration-300 shadow-sm">
                            <i class="fas fa-filter mr-2"></i>
                            Filter
                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                        </button>

                        <div x-show="open"
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700 py-3 z-50"
                            style="display: none;">
                            <div class="px-4 py-2">
                                <h4 class="font-semibold text-gray-900 dark:text-white text-sm mb-3">Filter by Department</h4>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="rounded border-gray-300 text-maroon focus:ring-maroon/50" checked>
                                        <span class="ml-2 text-gray-700 dark:text-gray-300 text-sm">All Departments</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" class="rounded border-gray-300 text-maroon focus:ring-maroon/50">
                                        <span class="ml-2 text-gray-700 dark:text-gray-300 text-sm">Science Department</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" class="rounded border-gray-300 text-maroon focus:ring-maroon/50">
                                        <span class="ml-2 text-gray-700 dark:text-gray-300 text-sm">Mathematics Department</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" class="rounded border-gray-300 text-maroon focus:ring-maroon/50">
                                        <span class="ml-2 text-gray-700 dark:text-gray-300 text-sm">Languages Department</span>
                                    </label>
                                </div>
                            </div>
                            <div class="border-t border-gray-100 dark:border-gray-700 px-4 py-3">
                                <button class="w-full px-3 py-2 bg-gradient-to-r from-maroon to-maroon-dark text-white font-medium rounded-lg transition-all duration-300">
                                    Apply Filters
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- View Toggle -->
                    <div class="flex items-center bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-xl p-1">
                        <button id="gridView" onclick="toggleView('grid')"
                                class="p-2 rounded-lg bg-white dark:bg-gray-600 shadow-sm text-maroon dark:text-white transition-all duration-300">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button id="listView" onclick="toggleView('list')"
                                class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:text-maroon dark:hover:text-white transition-all duration-300 ml-1">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teachers Grid View (Default) -->
        <div id="teachersGridView" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Teacher Card 1 -->
                <div class="teacher-card bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden group hover:scale-[1.02]">
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        JD
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 dark:text-white">John Doe</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Mathematics Teacher</p>
                                </div>
                            </div>
                            <span class="px-2 py-1 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/10 text-blue-700 dark:text-blue-400 text-xs font-semibold rounded-full">
                                TEA-2024
                            </span>
                        </div>

                        <!-- Details -->
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-envelope text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-300 ml-2 truncate">john.doe@school.edu</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-phone text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-300 ml-2">+256 712 345 678</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-sitemap text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-300 ml-2">Mathematics Department</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <span class="px-2 py-1 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/10 text-green-700 dark:text-green-400 text-xs font-semibold rounded-full">
                                    <i class="fas fa-circle text-[8px] mr-1"></i>
                                    Active
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">5 yrs exp.</span>
                            </div>
                            <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button onclick="viewTeacher(1)" class="p-2 text-gray-500 hover:text-maroon dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editTeacher(1)" class="p-2 text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteTeacher(1)" class="p-2 text-gray-500 hover:text-red-600 dark:hover:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teacher Card 2 -->
                <div class="teacher-card bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden group hover:scale-[1.02]">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        SJ
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 dark:text-white">Sarah Johnson</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Biology Teacher</p>
                                </div>
                            </div>
                            <span class="px-2 py-1 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/10 text-green-700 dark:text-green-400 text-xs font-semibold rounded-full">
                                TEA-2023
                            </span>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-envelope text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-300 ml-2 truncate">sarah.j@school.edu</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-phone text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-300 ml-2">+256 723 456 789</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-sitemap text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-300 ml-2">Science Department</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <span class="px-2 py-1 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/10 text-green-700 dark:text-green-400 text-xs font-semibold rounded-full">
                                    <i class="fas fa-circle text-[8px] mr-1"></i>
                                    Active
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">8 yrs exp.</span>
                            </div>
                            <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button onclick="viewTeacher(2)" class="p-2 text-gray-500 hover:text-maroon dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editTeacher(2)" class="p-2 text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteTeacher(2)" class="p-2 text-gray-500 hover:text-red-600 dark:hover:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teacher Card 3 -->
                <div class="teacher-card bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden group hover:scale-[1.02]">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        RB
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-yellow-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 dark:text-white">Robert Brown</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Head of Science</p>
                                </div>
                            </div>
                            <span class="px-2 py-1 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/10 text-purple-700 dark:text-purple-400 text-xs font-semibold rounded-full">
                                TEA-2019
                            </span>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-envelope text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-300 ml-2 truncate">robert.b@school.edu</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-phone text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-300 ml-2">+256 734 567 890</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-sitemap text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-gray-300 ml-2">Science Department</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <span class="px-2 py-1 bg-gradient-to-r from-yellow-50 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/10 text-yellow-700 dark:text-yellow-400 text-xs font-semibold rounded-full">
                                    <i class="fas fa-circle text-[8px] mr-1"></i>
                                    On Leave
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">12 yrs exp.</span>
                            </div>
                            <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button onclick="viewTeacher(3)" class="p-2 text-gray-500 hover:text-maroon dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editTeacher(3)" class="p-2 text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteTeacher(3)" class="p-2 text-gray-500 hover:text-red-600 dark:hover:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teacher Card 4 -->
                <div class="teacher-card bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden group hover:scale-[1.02]">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <div class="w-14 h-14 bg-gradient-to-r from-red-500 to-red-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        MW
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 dark:text-white">Mary Williams</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">English Teacher</p>
                                </div>
                            </div>
                            <span class="px-2 py-1 bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/10 text-red-700 dark:text-red-400 text-xs font-semibold rounded-full">
                                TEA-2022
                            </span>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-envelope text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-300 ml-2 truncate">mary.w@school.edu</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-phone text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-300 ml-2">+256 745 678 901</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-sitemap text-gray-400 dark:text-gray-500 w-5"></i>
                                <span class="text-gray-600 dark:text-gray-300 ml-2">Languages Department</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <span class="px-2 py-1 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/10 text-green-700 dark:text-green-400 text-xs font-semibold rounded-full">
                                    <i class="fas fa-circle text-[8px] mr-1"></i>
                                    Active
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">6 yrs exp.</span>
                            </div>
                            <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button onclick="viewTeacher(4)" class="p-2 text-gray-500 hover:text-maroon dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editTeacher(4)" class="p-2 text-gray-500 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteTeacher(4)" class="p-2 text-gray-500 hover:text-red-600 dark:hover:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add New Teacher Card -->
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-2xl shadow-lg border-2 border-dashed border-gray-300 dark:border-gray-600 hover:border-maroon dark:hover:border-maroon transition-all duration-300 group">
                    <a href="/admin/teachers/create" class="h-full flex flex-col items-center justify-center p-8 text-center hover:scale-[1.02] transition-transform duration-300">
                        <div class="w-20 h-20 bg-gradient-to-r from-maroon/10 to-maroon/5 rounded-2xl flex items-center justify-center mb-4 group-hover:from-maroon/20 group-hover:to-maroon/10 transition-all duration-300">
                            <i class="fas fa-user-plus text-maroon text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Add New Teacher</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Click here to add a new teacher to the system</p>
                        <span class="px-4 py-2 bg-gradient-to-r from-maroon to-maroon-dark text-white text-sm font-semibold rounded-lg transition-all duration-300">
                            Create New
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Teachers List View (Hidden by default) -->
        <div id="teachersListView" class="hidden p-6">
            <div class="overflow-x-auto rounded-xl border border-gray-100 dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Teacher
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                ID & Department
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Contact
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                        <!-- Teacher Row 1 -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-sm mr-3">
                                        JD
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900 dark:text-white">John Doe</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Mathematics Teacher</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">TEA-2024</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Mathematics Department</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">john.doe@school.edu</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">+256 712 345 678</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">
                                    Active
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <button onclick="viewTeacher(1)" class="text-maroon dark:text-maroon-light hover:text-maroon-dark dark:hover:text-maroon-lighter">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="editTeacher(1)" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteTeacher(1)" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Teacher Row 2 -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center text-white font-bold text-sm mr-3">
                                        SJ
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900 dark:text-white">Sarah Johnson</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Biology Teacher</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">TEA-2023</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Science Department</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">sarah.j@school.edu</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">+256 723 456 789</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">
                                    Active
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <button onclick="viewTeacher(2)" class="text-maroon dark:text-maroon-light hover:text-maroon-dark dark:hover:text-maroon-lighter">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="editTeacher(2)" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteTeacher(2)" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700 dark:text-gray-300">
                    Showing <span class="font-semibold">1</span> to <span class="font-semibold">4</span> of <span class="font-semibold">24</span> teachers
                </div>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-3 py-2 bg-gradient-to-r from-maroon to-maroon-dark text-white rounded-lg">1</button>
                    <button class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                        2
                    </button>
                    <button class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                        3
                    </button>
                    <button class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty State (Hidden by default) -->
    <div id="emptyState" class="hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-12 text-center">
        <div class="max-w-md mx-auto">
            <div class="w-24 h-24 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-users text-gray-400 dark:text-gray-500 text-4xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">No Teachers Found</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-8">You haven't added any teachers yet. Get started by adding your first teacher.</p>
            <a href="/admin/teachers/create"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-maroon to-maroon-dark hover:from-maroon-dark hover:to-maroon text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-user-plus mr-2"></i>
                Add Your First Teacher
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // View toggle functionality
    function toggleView(viewType) {
        const gridView = document.getElementById('teachersGridView');
        const listView = document.getElementById('teachersListView');
        const gridBtn = document.getElementById('gridView');
        const listBtn = document.getElementById('listView');

        if (viewType === 'grid') {
            gridView.classList.remove('hidden');
            listView.classList.add('hidden');
            gridBtn.classList.add('bg-white', 'dark:bg-gray-600', 'shadow-sm', 'text-maroon', 'dark:text-white');
            gridBtn.classList.remove('text-gray-500', 'dark:text-gray-400');
            listBtn.classList.remove('bg-white', 'dark:bg-gray-600', 'shadow-sm', 'text-maroon', 'dark:text-white');
            listBtn.classList.add('text-gray-500', 'dark:text-gray-400');
        } else {
            gridView.classList.add('hidden');
            listView.classList.remove('hidden');
            listBtn.classList.add('bg-white', 'dark:bg-gray-600', 'shadow-sm', 'text-maroon', 'dark:text-white');
            listBtn.classList.remove('text-gray-500', 'dark:text-gray-400');
            gridBtn.classList.remove('bg-white', 'dark:bg-gray-600', 'shadow-sm', 'text-maroon', 'dark:text-white');
            gridBtn.classList.add('text-gray-500', 'dark:text-gray-400');
        }
    }

    // Search functionality
    function filterTeachers() {
        const searchTerm = document.getElementById('teacherSearch').value.toLowerCase();
        const teacherCards = document.querySelectorAll('.teacher-card');
        let visibleCount = 0;

        teacherCards.forEach(card => {
            const text = card.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update count
        document.getElementById('totalTeachers').textContent = visibleCount;

        // Show/hide empty state
        const emptyState = document.getElementById('emptyState');
        if (visibleCount === 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }

    // Teacher actions (demo functions)
    function viewTeacher(id) {
        alert(`View teacher ${id} - Demo mode\nThis would open the teacher's profile page.`);
        // window.location.href = `/admin/teachers/${id}`;
    }

    function editTeacher(id) {
        alert(`Edit teacher ${id} - Demo mode\nThis would open the edit form.`);
        // window.location.href = `/admin/teachers/${id}/edit`;
    }

    function deleteTeacher(id) {
        if (confirm(`Are you sure you want to delete teacher ${id}?\nThis action cannot be undone.`)) {
            // Show deleting animation
            const deleteBtn = event.target.closest('button');
            const originalHTML = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            deleteBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                alert(`Teacher ${id} deleted successfully - Demo mode\nIn a real application, this would delete the record from the database.`);
                deleteBtn.innerHTML = originalHTML;
                deleteBtn.disabled = false;

                // Show success notification
                showNotification('Teacher deleted successfully!', 'success');
            }, 1000);
        }
    }

    // Notification function
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `fixed top-6 right-6 bg-gradient-to-r ${type === 'success' ? 'from-green-500 to-green-600' : 'from-red-500 to-red-600'} text-white px-6 py-4 rounded-xl shadow-2xl z-50 animate-slideIn`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} text-xl mr-3"></i>
                <div>
                    <p class="font-semibold">${message}</p>
                    <p class="text-sm opacity-90 mt-1">Demo mode - Action simulated</p>
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

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Set initial view to grid
        toggleView('grid');

        // Add click handlers for demo buttons
        document.querySelectorAll('.teacher-card').forEach((card, index) => {
            card.addEventListener('click', function(e) {
                if (!e.target.closest('button')) {
                    viewTeacher(index + 1);
                }
            });
        });
    });
</script>
@endpush

<style>
    /* Animation for notifications */
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

    /* Smooth transitions */
    .teacher-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Scrollbar styling */
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
