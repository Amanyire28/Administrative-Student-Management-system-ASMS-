<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'ASMS') }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        maroon: {
                            DEFAULT: '#800000',
                            dark: '#5f0000',
                            light: '#b34d4d'
                        },
                    },
                },
            },
        };
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Layout styles */
        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        @media (min-width: 1024px) {
            .desktop-layout {
                display: flex;
                min-height: 100vh;
                width: 100%;
            }

            .sidebar-area {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                width: 256px;
                z-index: 40;
                transition: width 0.3s ease;
                overflow-y: auto;
                overflow-x: hidden;
            }

            .sidebar-area.collapsed {
                width: 70px;
            }

            .main-content-area {
                flex: 1;
                margin-left: 256px;
                transition: margin-left 0.3s ease;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .main-content-area.collapsed {
                margin-left: 70px;
            }
        }

        /* Colors */
        .text-maroon { color: #800000 !important; }
        .bg-maroon { background-color: #800000 !important; }
        .hover\:bg-maroon:hover { background-color: #800000 !important; }
        .border-maroon { border-color: #800000 !important; }

        .dark .text-maroon { color: #b34d4d !important; }
        .dark .bg-maroon { background-color: #5f0000 !important; }
        .dark .border-maroon { border-color: #5f0000 !important; }

        /* Spinner */
        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #800000;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Page transition */
        .page-content {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #4a5568;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background: #718096;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <!-- Desktop Layout (lg and above) -->
    <div class="desktop-layout hidden lg:flex">
        <!-- Sidebar Area -->
        <div class="sidebar-area">
            @include('partials.sidebar')
        </div>

        <!-- Main Content Area -->
        <div class="main-content-area">
            <!-- Navbar -->
            @include('partials.navbar')

            <!-- Flash Messages Container -->
            <div id="flash-messages" class="px-6 pt-4">
                @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-4 rounded-lg flash-message"
                     x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 5000)"
                     x-transition>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 dark:text-green-400"></i>
                            <p class="ml-3 text-green-700 dark:text-green-300">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="text-green-500 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-4 rounded-lg flash-message"
                     x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 5000)"
                     x-transition>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 dark:text-red-400"></i>
                            <p class="ml-3 text-red-700 dark:text-red-300">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @endif

                @if(session('warning'))
                <div class="mb-6 bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-500 p-4 rounded-lg flash-message"
                     x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 5000)"
                     x-transition>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-yellow-500 dark:text-yellow-400"></i>
                            <p class="ml-3 text-yellow-700 dark:text-yellow-300">{{ session('warning') }}</p>
                        </div>
                        <button @click="show = false" class="text-yellow-500 dark:text-yellow-400 hover:text-yellow-700 dark:hover:text-yellow-300">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @endif
            </div>

            <!-- Loading Indicator -->
            <div id="loading-indicator"
                 class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center"
                 style="opacity: 0; pointer-events: none; transition: opacity 200ms;">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-2xl">
                    <div class="spinner"></div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="p-4 sm:p-6 lg:p-8 flex-1">
                <div id="page-content" class="page-content">
                    @hasSection('content')
                        @yield('content')
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-exclamation-triangle text-6xl text-yellow-500 mb-4"></i>
                            <h2 class="text-2xl font-bold mb-2">No Content</h2>
                            <p class="text-gray-600 dark:text-gray-400">Please define a @section('content') in your view.</p>
                        </div>
                    @endif
                </div>
            </main>

            <!-- Footer -->
            @include('partials.footer')
        </div>
    </div>

    <!-- Mobile Layout (below lg) -->
    <div class="lg:hidden">
        @include('partials.mobile-nav')
        @include('partials.mobile-sidebar')

        <div class="pt-16 pb-20">
            <!-- Mobile Flash Messages -->
            <div id="flash-messages-mobile" class="p-4">
                @if(session('success'))
                <div class="mb-4 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 p-3 rounded-lg flash-message"
                     x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 5000)"
                     x-transition>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 text-sm"></i>
                            <p class="ml-3 text-green-700 dark:text-green-300 text-sm">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="text-green-500">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 p-3 rounded-lg flash-message"
                     x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 5000)"
                     x-transition>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 text-sm"></i>
                            <p class="ml-3 text-red-700 dark:text-red-300 text-sm">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="text-red-500">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                </div>
                @endif
            </div>

            <!-- Mobile Loading Indicator -->
            <div id="loading-indicator-mobile"
                 class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center"
                 style="opacity: 0; pointer-events: none; transition: opacity 200ms;">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-2xl">
                    <div class="spinner"></div>
                </div>
            </div>

            <!-- Mobile Page Content -->
            <main class="p-4">
                <div id="page-content-mobile" class="page-content">
                    @hasSection('content')
                        @yield('content')
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-exclamation-triangle text-5xl text-yellow-500 mb-4"></i>
                            <h2 class="text-xl font-bold mb-2">No Content</h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Please define a @section('content') in your view.</p>
                        </div>
                    @endif
                </div>
            </main>
        </div>

        @include('partials.mobile-bottom-nav')
    </div>

    <!-- SPA Router -->
    <script src="{{ asset('js/spa-router.js') }}"></script>

    <!-- Alpine.js Component Definitions -->
    <script>
        document.addEventListener('alpine:init', () => {
            // Sidebar Data Component
            Alpine.data('sidebarData', () => ({
                dropdowns: {
                    students: false,
                    teachers: false,
                    marks: false,
                    reports: false
                },
                sidebarCollapsed: false,
                currentPath: window.location.pathname,

                init() {
                    // Initialize collapsed state from localStorage
                    try {
                        this.sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                        this.applySidebarState();
                    } catch (e) {
                        console.warn('Could not read sidebar state:', e);
                        this.sidebarCollapsed = false;
                    }

                    // Set initial dropdown states based on current URL
                    this.updateDropdownsFromURL(this.currentPath);

                    // Listen for SPA navigation
                    window.addEventListener('spa:navigated', (e) => {
                        this.currentPath = e.detail.path || window.location.pathname;
                        this.updateDropdownsFromURL(this.currentPath);
                    });

                    // Listen for browser back/forward
                    window.addEventListener('popstate', () => {
                        this.currentPath = window.location.pathname;
                        this.updateDropdownsFromURL(this.currentPath);
                    });

                    // Listen for sidebar toggle from navbar
                    document.addEventListener('toggle-sidebar', () => {
                        this.toggleSidebar();
                    });

                    // Close dropdowns when clicking outside
                    document.addEventListener('click', (e) => {
                        if (!this.$el.contains(e.target)) {
                            this.closeAllDropdowns();
                        }
                    });

                    console.log('✅ Sidebar Alpine component initialized');
                },

                updateDropdownsFromURL(path) {
                    this.closeAllDropdowns();

                    if (!this.sidebarCollapsed) {
                        if (path.startsWith('/admin/students')) this.dropdowns.students = true;
                        else if (path.startsWith('/admin/teachers')) this.dropdowns.teachers = true;
                        else if (path.startsWith('/admin/marks')) this.dropdowns.marks = true;
                        else if (path.startsWith('/admin/report-card')) this.dropdowns.reports = true;
                    }
                },

                toggleDropdown(name, event) {
                    if (event) event.stopPropagation();

                    if (this.dropdowns[name]) {
                        this.dropdowns[name] = false;
                    } else {
                        this.closeAllDropdowns();
                        this.dropdowns[name] = true;
                    }
                },

                closeAllDropdowns() {
                    Object.keys(this.dropdowns).forEach(key => {
                        this.dropdowns[key] = false;
                    });
                },

                handleLinkClick() {
                    setTimeout(() => this.closeAllDropdowns(), 100);
                },

                isActive(path) {
                    if (!path || path === '#') return false;
                    return this.currentPath === path || this.currentPath.startsWith(path + '/');
                },

                isExactActive(path) {
                    return this.currentPath === path;
                },

                toggleSidebar() {
                    this.sidebarCollapsed = !this.sidebarCollapsed;

                    try {
                        localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
                    } catch (e) {
                        console.warn('Could not save sidebar state:', e);
                    }

                    this.applySidebarState();

                    // Close all dropdowns when collapsing
                    if (this.sidebarCollapsed) {
                        this.closeAllDropdowns();
                    } else {
                        // Reopen appropriate dropdown when expanding
                        this.updateDropdownsFromURL(this.currentPath);
                    }

                    console.log('✅ Sidebar:', this.sidebarCollapsed ? 'collapsed' : 'expanded');
                },

                applySidebarState() {
                    const sidebar = document.querySelector('.sidebar');
                    const sidebarArea = document.querySelector('.sidebar-area');
                    const mainContent = document.querySelector('.main-content-area');
                    const toggleIcon = document.querySelector('#sidebarToggle i');

                    if (this.sidebarCollapsed) {
                        sidebar?.classList.add('collapsed');
                        sidebarArea?.classList.add('collapsed');
                        mainContent?.classList.add('collapsed');
                        toggleIcon?.classList.remove('fa-chevron-left');
                        toggleIcon?.classList.add('fa-chevron-right');
                    } else {
                        sidebar?.classList.remove('collapsed');
                        sidebarArea?.classList.remove('collapsed');
                        mainContent?.classList.remove('collapsed');
                        toggleIcon?.classList.remove('fa-chevron-right');
                        toggleIcon?.classList.add('fa-chevron-left');
                    }
                }
            }));
        });
    </script>

    <!-- Theme Management -->
    <script>
        // Global theme management
        window.appTheme = {
            current: 'light',

            init() {
                try {
                    this.current = localStorage.getItem('theme') || 'light';
                } catch (e) {
                    console.warn('Could not read theme:', e);
                }
                this.apply();
            },

            toggle() {
                this.current = this.current === 'light' ? 'dark' : 'light';
                this.apply();
                try {
                    localStorage.setItem('theme', this.current);
                } catch (e) {
                    console.warn('Could not save theme:', e);
                }
                console.log('✅ Theme:', this.current);
            },

            apply() {
                document.documentElement.classList.toggle('dark', this.current === 'dark');
            }
        };

        // Initialize theme on load
        window.appTheme.init();
    </script>

    <!-- App Initialization & Helpers -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('✅ App initialized');
            console.log('📱 User Agent:', navigator.userAgent);

            // Listen for navigation events
            window.addEventListener('spa:navigated', (e) => {
                console.log('📍 Navigated to:', e.detail.path);
            });

            window.addEventListener('spa:rendered', (e) => {
                console.log('🎨 Content rendered');
            });
        });

        // Global helper functions
        window.showAlert = (msg, type = 'success') => {
            if (window.router && typeof window.router.showAlert === 'function') {
                window.router.showAlert(msg, type);
            } else {
                console.warn('Router not available for showAlert');
                alert(msg);
            }
        };

        window.navigateTo = (path, opts = {}) => {
            if (window.router && typeof window.router.navigate === 'function') {
                window.router.navigate(path, opts);
            } else {
                console.warn('Router not available for navigation');
                window.location.href = path;
            }
        };

        window.refreshPage = () => {
            if (window.router && typeof window.router.refresh === 'function') {
                window.router.refresh();
            } else {
                window.location.reload();
            }
        };

        window.toggleTheme = () => {
            if (window.appTheme && typeof window.appTheme.toggle === 'function') {
                window.appTheme.toggle();
            }


        };


        // Add this to your App Initialization & Helpers script section
window.toggleSidebar = function() {
    // Method 1: Dispatch the event that Alpine.js is listening for
    document.dispatchEvent(new CustomEvent('toggle-sidebar'));

    // Method 2: Directly access the Alpine.js component
    const sidebarEl = document.querySelector('[x-data*="sidebarData"]');
    if (sidebarEl && sidebarEl.__x) {
        sidebarEl.__x.$data.toggleSidebar();
    }
};
    </script>

    @stack('scripts')
</body>
</html>
