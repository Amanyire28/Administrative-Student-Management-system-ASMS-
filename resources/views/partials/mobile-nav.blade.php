<!-- ============================================ -->
<!-- FILE: resources/views/partials/mobile-nav.blade.php -->
<!-- ============================================ -->

<!-- Mobile Header -->
<div class="bg-white dark:bg-gray-800 shadow-sm fixed top-0 left-0 right-0 z-40 safe-top lg:hidden">
    <div class="px-4 py-3 flex justify-between items-center">
        <!-- Menu Button -->
        <button onclick="openMobileSidebar()" class="text-gray-600 dark:text-gray-300 hover:text-maroon p-2">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Logo/Brand -->
        <div class="flex items-center">
            <div class="w-8 h-8 bg-maroon rounded-full flex items-center justify-center mr-2">
                <span class="text-white font-bold text-xs">AS</span>
            </div>
            <span class="font-bold text-maroon dark:text-maroon-light text-lg">{{ config('app.name', 'ASMS') }}</span>
        </div>

        <!-- Right side buttons -->
        <div class="flex items-center space-x-2">
            <!-- Theme Toggle for Mobile -->
            <button onclick="window.toggleTheme()" class="text-gray-600 dark:text-gray-300 hover:text-maroon p-2">
                <i id="mobileThemeIcon" class="fas fa-moon text-lg"></i>
            </button>

            <!-- Search Button -->
            <button onclick="toggleMobileSearch()" class="text-gray-600 dark:text-gray-300 hover:text-maroon p-2">
                <i class="fas fa-search text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Search Bar (Hidden by default) -->
    <div id="mobileSearchBar" class="px-4 py-3 bg-gray-50 dark:bg-gray-700 hidden">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text"
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white rounded-lg focus:ring-2 focus:ring-maroon/50 focus:border-maroon focus:outline-none"
                   placeholder="Search students, teachers, classes...">
            <button onclick="toggleMobileSearch()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <i class="fas fa-times text-gray-400"></i>
            </button>
        </div>
    </div>
</div>

<!-- Mobile Notifications Panel -->
<div id="mobileNotifications" class="fixed inset-0 bg-white dark:bg-gray-800 z-50 transform translate-x-full transition-transform duration-300 lg:hidden">
    <div class="h-full flex flex-col">
        <!-- Notifications Header -->
        <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Notifications</h3>
            <button onclick="closeMobileNotifications()" class="text-gray-600 dark:text-gray-300 hover:text-maroon p-2">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Notifications Content -->
        <div class="flex-1 overflow-y-auto p-4">
            <!-- Today -->
            <div class="mb-6">
                <h4 class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-3">Today</h4>
                <div class="space-y-3">
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3">
                        <div class="flex items-start">
                            <div class="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg mr-3">
                                <i class="fas fa-user-plus text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">New Student Registration</p>
                                <p class="text-gray-600 dark:text-gray-300 text-sm">John Doe has been registered in Grade 10A</p>
                                <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">2 hours ago</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-3">
                        <div class="flex items-start">
                            <div class="p-2 bg-green-100 dark:bg-green-800 rounded-lg mr-3">
                                <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">Attendance Submitted</p>
                                <p class="text-gray-600 dark:text-gray-300 text-sm">Class 10B attendance has been submitted</p>
                                <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">3 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Yesterday -->
            <div class="mb-6">
                <h4 class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-3">Yesterday</h4>
                <div class="space-y-3">
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-3">
                        <div class="flex items-start">
                            <div class="p-2 bg-yellow-100 dark:bg-yellow-800 rounded-lg mr-3">
                                <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">Low Attendance Alert</p>
                                <p class="text-gray-600 dark:text-gray-300 text-sm">Class 9C has 60% attendance this week</p>
                                <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">1 day ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mark All as Read -->
        <div class="border-t border-gray-200 dark:border-gray-700 p-4">
            <button class="w-full bg-maroon text-white py-3 rounded-lg font-medium hover:bg-maroon-dark transition">
                Mark All as Read
            </button>
        </div>
    </div>
</div>

<!-- Mobile Profile Menu -->
<div id="mobileProfileMenu" class="fixed inset-0 bg-white dark:bg-gray-800 z-50 transform translate-x-full transition-transform duration-300 lg:hidden">
    <div class="h-full flex flex-col">
        <!-- Profile Header -->
        <div class="bg-maroon text-white p-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                    <span class="text-maroon font-bold text-2xl">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold">{{ auth()->user()->name ?? 'User' }}</h3>
                    <p class="text-white/80">{{ auth()->user()->role ?? 'Administrator' }}</p>
                </div>
            </div>
            <button onclick="closeMobileProfileMenu()"
                    class="absolute top-4 right-4 text-white hover:bg-white/20 p-2 rounded-full">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Profile Content -->
        <div class="flex-1 overflow-y-auto">
            <div class="p-4">
                <div class="space-y-1">
                    <a href="/profile" class="flex items-center p-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-user text-gray-600 dark:text-gray-300 w-6 mr-3"></i>
                        <span class="text-gray-800 dark:text-white">My Profile</span>
                    </a>

                    <a href="/admin/settings" class="flex items-center p-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-cog text-gray-600 dark:text-gray-300 w-6 mr-3"></i>
                        <span class="text-gray-800 dark:text-white">Settings</span>
                    </a>

                    <button onclick="openMobileNotifications(); closeMobileProfileMenu();"
                            class="flex items-center w-full p-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-bell text-gray-600 dark:text-gray-300 w-6 mr-3"></i>
                        <span class="text-gray-800 dark:text-white">Notifications</span>
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">3</span>
                    </button>

                    <!-- Theme Toggle in Mobile Menu -->
                    <button onclick="window.toggleTheme()"
                            class="flex items-center w-full p-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i id="mobileMenuThemeIcon" class="fas fa-moon text-gray-600 dark:text-gray-300 w-6 mr-3"></i>
                        <span class="text-gray-800 dark:text-white">Dark Mode</span>
                        <span id="themeStatus" class="ml-auto text-xs text-gray-500">Off</span>
                    </button>

                    <a href="#" class="flex items-center p-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-shield-alt text-gray-600 dark:text-gray-300 w-6 mr-3"></i>
                        <span class="text-gray-800 dark:text-white">Privacy & Security</span>
                    </a>

                    <a href="#" class="flex items-center p-4 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-question-circle text-gray-600 dark:text-gray-300 w-6 mr-3"></i>
                        <span class="text-gray-800 dark:text-white">Help & Support</span>
                    </a>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex items-center w-full p-4 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg">
                            <i class="fas fa-sign-out-alt w-6 mr-3"></i>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Action Buttons (Floating) -->
<div class="lg:hidden fixed bottom-20 right-4 z-30 safe-bottom">
    <div class="flex flex-col items-center space-y-3">
        <!-- Quick Add Button -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                    class="w-14 h-14 bg-maroon rounded-full shadow-lg flex items-center justify-center text-white hover:bg-maroon-dark transition">
                <i class="fas fa-plus text-xl transition-transform duration-200" :class="{'rotate-45': open}"></i>
            </button>

            <!-- Quick Add Menu -->
            <div x-show="open"
                 @click.away="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                 style="display: none;"
                 class="absolute bottom-full right-0 mb-3 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 py-2">
                <a href="/admin/students/create" @click="open = false" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <i class="fas fa-user-plus text-blue-600 dark:text-blue-400 w-5 mr-3"></i>
                    <span class="text-gray-800 dark:text-white">New Student</span>
                </a>
                <a href="/admin/teachers/create" @click="open = false" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <i class="fas fa-chalkboard-teacher text-green-600 dark:text-green-400 w-5 mr-3"></i>
                    <span class="text-gray-800 dark:text-white">New Teacher</span>
                </a>
                <a href="/admin/marks-entry" @click="open = false" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <i class="fas fa-edit text-purple-600 dark:text-purple-400 w-5 mr-3"></i>
                    <span class="text-gray-800 dark:text-white">Enter Marks</span>
                </a>
                <a href="/admin/classes/create" @click="open = false" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <i class="fas fa-chalkboard text-orange-600 dark:text-orange-400 w-5 mr-3"></i>
                    <span class="text-gray-800 dark:text-white">New Class</span>
                </a>
            </div>
        </div>

        <!-- Notifications Button -->
        <button onclick="openMobileNotifications()"
                class="w-12 h-12 bg-white dark:bg-gray-800 rounded-full shadow-lg flex items-center justify-center text-gray-600 dark:text-gray-300 hover:text-maroon relative">
            <i class="fas fa-bell text-lg"></i>
            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
        </button>

        <!-- Profile Button -->
        <button onclick="openMobileProfileMenu()"
                class="w-12 h-12 bg-white dark:bg-gray-800 rounded-full shadow-lg flex items-center justify-center text-gray-600 dark:text-gray-300 hover:text-maroon">
            <i class="fas fa-user text-lg"></i>
        </button>
    </div>
</div>

<script>
    // Mobile navigation functions
    function toggleMobileSearch() {
        const searchBar = document.getElementById('mobileSearchBar');
        searchBar.classList.toggle('hidden');
    }

    function openMobileNotifications() {
        document.getElementById('mobileNotifications').classList.remove('translate-x-full');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileNotifications() {
        document.getElementById('mobileNotifications').classList.add('translate-x-full');
        document.body.style.overflow = 'auto';
    }

    function openMobileProfileMenu() {
        document.getElementById('mobileProfileMenu').classList.remove('translate-x-full');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileProfileMenu() {
        document.getElementById('mobileProfileMenu').classList.add('translate-x-full');
        document.body.style.overflow = 'auto';
    }

    // Update mobile theme icons
    function updateMobileThemeIcons() {
        const currentTheme = window.appTheme?.current || localStorage.getItem('theme') || 'light';
        const mobileThemeIcon = document.getElementById('mobileThemeIcon');
        const mobileMenuThemeIcon = document.getElementById('mobileMenuThemeIcon');
        const themeStatus = document.getElementById('themeStatus');

        if (mobileThemeIcon) {
            mobileThemeIcon.className = currentTheme === 'light' ? 'fas fa-moon text-lg' : 'fas fa-sun text-lg';
        }

        if (mobileMenuThemeIcon) {
            mobileMenuThemeIcon.className = currentTheme === 'light' ? 'fas fa-moon text-gray-600 dark:text-gray-300 w-6 mr-3' : 'fas fa-sun text-gray-600 dark:text-gray-300 w-6 mr-3';
        }

        if (themeStatus) {
            themeStatus.textContent = currentTheme === 'light' ? 'Off' : 'On';
            themeStatus.className = currentTheme === 'light' ? 'ml-auto text-xs text-gray-500' : 'ml-auto text-xs text-yellow-500';
        }
    }

    // Initialize mobile theme on load
    document.addEventListener('DOMContentLoaded', function() {
        updateMobileThemeIcons();
        updateSafeAreas();
    });

    // Listen for theme changes
    document.addEventListener('themeChanged', updateMobileThemeIcons);

    // Update safe areas for modern phones
    function updateSafeAreas() {
        const elements = document.querySelectorAll('.safe-top, .safe-bottom');
        elements.forEach(el => {
            if (el.classList.contains('safe-top')) {
                el.style.paddingTop = 'calc(env(safe-area-inset-top) + 0.75rem)';
            }
            if (el.classList.contains('safe-bottom')) {
                el.style.paddingBottom = 'calc(env(safe-area-inset-bottom) + 0.75rem)';
            }
        });
    }

    // Update on resize
    window.addEventListener('resize', updateSafeAreas);
</script>
