<nav class="navbar navbar-light bg-light px-3 px-lg-4 shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Left side: Mobile toggle + Brand (large screens only) -->
        <div class="d-flex align-items-center">
            <!-- Mobile sidebar toggle (visible only on mobile) -->
            <button class="btn btn-link d-md-none p-0" 
                    type="button" 
                    id="sidebarToggle"
                    aria-label="Toggle sidebar"
                    style="color: #8B0000; font-size: 1.2rem; border: none; background: none;">
                <i class="fas fa-bars"></i>
            </button>
            
            <!-- Brand (visible only on large screens) -->
            <div class="d-none d-lg-flex align-items-center">
                <div class="brand-container d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                         style="width: 35px; height: 35px; background: linear-gradient(135deg, #8B0000, #A52A2A); box-shadow: 0 2px 8px rgba(139,0,0,0.3);">
                        <i class="fas fa-graduation-cap text-white" style="font-size: 0.9rem;"></i>
                    </div>
                    <div class="brand-text">
                        <h6 class="fw-bold mb-0" style="color: #8B0000; font-size: 1rem; letter-spacing: 1px;">ASMS</h6>
                        <small style="color: #6c757d; font-size: 0.7rem;">Administrative Student Management System</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side: User profile dropdown -->
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle d-flex align-items-center text-decoration-none border-0 p-0" 
                    type="button" 
                    id="userDropdown" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false"
                    style="border: none; background: none;">
                <!-- Circular avatar -->
                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white me-2" 
                     style="width: 40px; height: 40px; background-color: #8B0000; font-size: 14px; cursor: pointer;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'Admin', 0, 2)) }}
                </div>
                <!-- User name (hidden on mobile) -->
                <div class="d-none d-md-block me-2">
                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">{{ auth()->user()->name ?? 'Administrator' }}</span>
                </div>
                <!-- Dropdown arrow -->
                <i class="fas fa-chevron-down text-muted small"></i>
            </button>
            
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" 
                aria-labelledby="userDropdown" 
                style="min-width: 200px; border-radius: 10px;">
                <!-- User info header -->
                <li class="px-3 py-2 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold text-white" 
                             style="width: 35px; height: 35px; background-color: #8B0000; font-size: 12px;">
                            {{ strtoupper(substr(auth()->user()->name ?? 'Admin', 0, 2)) }}
                        </div>
                        <div>
                            <div class="fw-bold small">{{ auth()->user()->name ?? 'Administrator' }}</div>
                            <div class="text-muted small">{{ auth()->user()->email ?? 'admin@asms.com' }}</div>
                        </div>
                    </div>
                </li>
                
                <!-- Menu items -->
                <li>
                    <a class="dropdown-item py-2" href="#" onclick="alert('Profile page coming soon!')">
                        <i class="fas fa-user me-2 text-muted"></i>My Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" onclick="alert('Account settings coming soon!')">
                        <i class="fas fa-cog me-2 text-muted"></i>Account Settings
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" onclick="alert('Preferences coming soon!')">
                        <i class="fas fa-sliders-h me-2 text-muted"></i>Preferences
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" onclick="alert('Help & Support coming soon!')">
                        <i class="fas fa-question-circle me-2 text-muted"></i>Help & Support
                    </a>
                </li>
                
                <li><hr class="dropdown-divider my-2"></li>
                
                <!-- Logout -->
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline w-100">
                        @csrf
                        <button type="submit" 
                                class="dropdown-item py-2 text-danger border-0 bg-transparent w-100 text-start"
                                style="border: none !important;">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>

                        <!-- Quick Add Dropdown -->
                        <div x-show="open"
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="absolute right-0 mt-3 w-64 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-700 py-3 z-50 overflow-hidden"
                            style="display: none;">
                            <div class="px-4 py-3 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 border-b border-gray-100 dark:border-gray-700">
                                <h3 class="font-bold text-gray-900 dark:text-white text-sm">Quick Actions</h3>
                            </div>

                            <div class="py-2">
                                @can('students.create')
                                <a href="/admin/students/create"
                                class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/10 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-200">
                                        <i class="fas fa-user-plus text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">New Student</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Add student record</p>
                                    </div>
                                </a>
                                @endcan

                                @can('teachers.create')
                                <a href="/admin/teachers/create"
                                class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/10 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-200">
                                        <i class="fas fa-chalkboard-teacher text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">New Teacher</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Add teacher record</p>
                                    </div>
                                </a>
                                @endcan

                                @can('marks.entry')
                                <a href="/admin/marks-entry"
                                class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/10 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-200">
                                        <i class="fas fa-edit text-purple-600 dark:text-purple-400"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">Enter Marks</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Record student marks</p>
                                    </div>
                                </a>
                                @endcan

                                @can('classes.create')
                                <a href="/admin/classes/create"
                                class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/10 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-200">
                                        <i class="fas fa-chalkboard text-orange-600 dark:text-orange-400"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm">New Class</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Create class section</p>
                                    </div>
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @endcanany

            </div>

            <!-- User Profile -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center space-x-2 sm:space-x-3 p-2 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 group">
                    <!-- Avatar -->
                    <div class="relative">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 bg-gradient-to-r from-maroon to-maroon-dark rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-300">
                            <span class="text-white font-bold text-sm">MA</span>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-3 h-3 sm:w-4 sm:h-4 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                    </div>

                    <!-- User Info (Visible on medium screens and up) -->
                    <div class="hidden md:block text-left">
                        <p class="font-bold text-gray-900 dark:text-white text-sm tracking-tight">Matthew </p>
                        <p class="text-xs text-maroon dark:text-maroon-light font-medium flex items-center">
                            <i class="fas fa-shield-alt mr-1 text-[10px]"></i>
                            Admin
                        </p>
                    </div>

                    <!-- Dropdown Icon -->
                    <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400 text-xs hidden md:block transition-transform duration-300"
                       :class="open ? 'rotate-180' : ''"></i>
                </button>

                <!-- User Dropdown Menu -->
                <div x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    class="absolute right-0 mt-3 w-80 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden z-50"
                    style="display: none;">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 px-6 py-5">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-gradient-to-r from-maroon to-maroon-dark rounded-2xl flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold text-lg">MA</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-900 dark:text-white text-lg">Matthew Amanyire</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">admin@asms.com</p>
                                <div class="flex items-center mt-2">
                                    <span class="px-3 py-1 bg-gradient-to-r from-maroon/10 to-maroon/5 text-maroon dark:text-maroon-light text-xs font-bold rounded-full">
                                        <i class="fas fa-shield-alt mr-1"></i>
                                        Super Admin
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div class="py-3">
                        <a href="#" class="flex items-center px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 group">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-gray-700 dark:text-gray-300"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white">My Profile</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">View & edit profile</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                        </a>

                        <a href="#" class="flex items-center px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 group">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center mr-3">
                                <i class="fas fa-cog text-gray-700 dark:text-gray-300"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white">Settings</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">System preferences</p>
                            </div>
                            <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-xs font-bold rounded-full">3</span>
                        </a>

                        <a href="#" class="flex items-center px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200 group">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center mr-3">
                                <i class="fas fa-bell text-gray-700 dark:text-gray-300"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white">Notifications</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Manage notifications</p>
                            </div>
                            <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-xs font-bold rounded-full">3</span>
                        </a>
                    </div>

                    <!-- Logout -->
                    <div class="border-t border-gray-100 dark:border-gray-700 px-6 py-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/10 hover:from-red-100 hover:to-red-200 dark:hover:from-red-800/30 dark:hover:to-red-700/20 text-red-600 dark:text-red-400 font-semibold rounded-xl transition-all duration-300 group">
                                <i class="fas fa-sign-out-alt mr-3 group-hover:animate-pulse"></i>
                                Sign Out
                                <i class="fas fa-arrow-right ml-auto text-sm opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all duration-300"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Search Bar -->
    <div id="mobile-search" class="mt-4 hidden lg:hidden">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400 dark:text-gray-500"></i>
            </div>
            <input type="text"
                class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-2xl focus:border-maroon focus:ring-4 focus:ring-maroon/10 bg-white dark:bg-gray-700/50 backdrop-blur-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 shadow-sm transition-all duration-300"
                placeholder="Search students, teachers, classes..."
                data-search-input>
        </div>
    </div>
</nav>

<style>
/* Custom navbar styles */
.dropdown-toggle::after {
    display: none !important;
}

/* Show custom dropdown arrow */
.dropdown .fas.fa-chevron-down {
    display: inline-block !important;
}

/* Brand styling for large screens */
.brand-container {
    transition: all 0.3s ease;
    cursor: pointer;
}

.brand-container:hover {
    transform: translateY(-1px);
}

.brand-container .rounded-circle {
    transition: all 0.3s ease;
}

.brand-container:hover .rounded-circle {
    transform: scale(1.1) rotate(5deg);
    box-shadow: 0 4px 12px rgba(139,0,0,0.4) !important;
}

.brand-container .fas {
    transition: all 0.3s ease;
}

.brand-container:hover .fas {
    transform: scale(1.1);
}

.brand-text h6 {
    transition: all 0.3s ease;
}

.brand-container:hover .brand-text h6 {
    color: #A52A2A !important;
}

.brand-text small {
    transition: all 0.3s ease;
}

.brand-container:hover .brand-text small {
    color: #8B0000 !important;
}

.dropdown-menu {
    border: 1px solid rgba(0,0,0,0.1) !important;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
}

.dropdown-item:hover {
    background-color: rgba(139, 0, 0, 0.1) !important;
    color: #8B0000 !important;
}

.dropdown-item:hover i {
    color: #8B0000 !important;
}

/* Avatar hover effect */
.rounded-circle:hover {
    transform: scale(1.05);
    transition: transform 0.2s ease;
}

/* User name styling */
.dropdown button span {
    transition: color 0.3s ease;
}

.dropdown:hover button span {
    color: #8B0000 !important;
}

/* Sidebar toggle button - ensure no Bootstrap interference */
#sidebarToggle {
    border: none !important;
    background: none !important;
    box-shadow: none !important;
    outline: none !important;
}

#sidebarToggle:focus {
    box-shadow: none !important;
    outline: none !important;
}

#sidebarToggle:active {
    background: none !important;
    border: none !important;
}

/* Profile dropdown button */
#userDropdown {
    border: none !important;
    background: none !important;
    box-shadow: none !important;
    outline: none !important;
}

#userDropdown:focus {
    box-shadow: none !important;
    outline: none !important;
}

#userDropdown:active {
    background: none !important;
    border: none !important;
}
</style>
