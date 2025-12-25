<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



<nav class="navbar bg-white dark:bg-gray-800 shadow-sm px-4 md:px-6 py-3 md:py-4 border-b border-gray-200 dark:border-gray-700">
    <div class="flex justify-between items-center">
        <!-- Left side: Page title and sidebar toggle -->
        <div class="flex items-center space-x-3 md:space-x-4">
            <!-- Desktop sidebar toggle -->
            <button id="sidebarToggle" onclick="toggleSidebar()"
                class="text-gray-600 dark:text-gray-300 hover:text-maroon dark:hover:text-primary-light p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <i class="fas fa-chevron-left text-lg md:text-xl"></i>
            </button>

            <!-- Page title -->
            <div class="min-w-0">
                <h1 class="text-lg md:text-xl font-semibold text-gray-800 dark:text-gray-100 truncate">
                    @yield('page-title', 'Dashboard')
                </h1>
                <div class="text-xs md:text-sm text-gray-500 dark:text-gray-300 truncate">
                    <span>@yield('page-description', 'Welcome to ASMS')</span>
                </div>
            </div>
        </div>

        <!-- Right side: Search, notifications, theme toggle, user menu -->
        <div class="flex items-center space-x-2 md:space-x-4">
            <!-- Search for desktop - Hidden on small screens -->
            <div class="relative hidden md:block">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 dark:text-gray-400 text-sm"></i>
                </div>
                <input type="text"
                    class="pl-9 pr-3 py-2 w-48 lg:w-56 xl:w-64 border border-gray-300 dark:border-gray-600 rounded-lg
                           focus:ring-2 focus:ring-maroon/50 focus:border-maroon focus:outline-none
                           bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 text-sm transition-all duration-300"
                    placeholder="Search...">
            </div>

            <!-- Mobile Search Button -->
            <button class="md:hidden text-gray-600 dark:text-gray-300 hover:text-maroon dark:hover:text-primary-light p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    onclick="document.getElementById('mobile-search').classList.toggle('hidden')">
                <i class="fas fa-search text-lg"></i>
            </button>

            <!-- Mobile Search Input -->
            <div id="mobile-search" class="absolute top-16 left-0 right-0 px-4 py-2 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 hidden md:hidden z-40">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 dark:text-gray-400"></i>
                    </div>
                    <input type="text"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg
                               focus:ring-2 focus:ring-maroon/50 focus:border-maroon focus:outline-none
                               bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100"
                        placeholder="Search students, teachers, classes...">
                </div>
            </div>

            <!-- Theme Toggle -->
            <div class="relative" x-data="{ theme: localStorage.getItem('theme') || 'light' }"
                 x-init="$watch('theme', val => {
                    localStorage.setItem('theme', val);
                    document.documentElement.classList.toggle('dark', val === 'dark');
                    updateTheme(val);
                 })">
                <button @click="theme = theme === 'light' ? 'dark' : 'light'"
                    class="p-2 text-gray-600 dark:text-gray-300 hover:text-maroon dark:hover:text-primary-light rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    :title="theme === 'light' ? 'Switch to dark mode' : 'Switch to light mode'">
                    <i class="fas text-base md:text-lg" :class="theme === 'light' ? 'fa-moon' : 'fa-sun'"></i>
                </button>
            </div>

            <!-- Notifications -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="p-2 text-gray-600 dark:text-gray-300 hover:text-maroon dark:hover:text-primary-light relative rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <i class="fas fa-bell text-lg md:text-xl"></i>
                    <span class="absolute -top-1 -right-1 w-4 h-4 md:w-5 md:h-5 bg-red-600 text-white text-[10px] md:text-xs rounded-full flex items-center justify-center">3</span>
                </button>

                <!-- Notifications Dropdown -->
                <div x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-72 md:w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 py-2 z-50">
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-100 text-sm md:text-base">Notifications</h3>
                        <p class="text-xs md:text-sm text-gray-600 dark:text-gray-300">You have 3 new notifications</p>
                    </div>
                    <div class="max-h-80 overflow-y-auto">
                        <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 md:w-10 md:h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-plus text-blue-700 dark:text-blue-400 text-sm md:text-base"></i>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-xs md:text-sm font-medium text-gray-800 dark:text-gray-100">New Student Registered</p>
                                <p class="text-xs text-gray-600 dark:text-gray-300 truncate">John Doe enrolled in Grade 10A</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">2 hours ago</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 md:w-10 md:h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check-circle text-green-700 dark:text-green-400 text-sm md:text-base"></i>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-xs md:text-sm font-medium text-gray-800 dark:text-gray-100">Attendance Submitted</p>
                                <p class="text-xs text-gray-600 dark:text-gray-300 truncate">Class 10B attendance submitted</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">3 hours ago</p>
                            </div>
                        </a>
                    </div>
                    <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-700">
                        <a href="#" class="block text-center text-xs md:text-sm text-maroon dark:text-primary-light hover:text-maroon-dark dark:hover:text-primary-lighter font-medium">
                            View all notifications
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Add -->
            <div class="relative hidden md:block" x-data="{ open: false }">
                <button @click="open = !open"
                    class="p-2 text-gray-600 dark:text-gray-300 hover:text-maroon dark:hover:text-primary-light rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <i class="fas fa-plus text-lg md:text-xl"></i>
                </button>

                <!-- Quick Add Dropdown -->
                <div x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 py-2 z-50">
                    <a href="{{ route('students.create') }}" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i class="fas fa-user-plus text-blue-700 dark:text-blue-400 w-4 md:w-5 mr-3"></i>
                        <span class="text-gray-800 dark:text-gray-100 text-sm">New Student</span>
                    </a>
                    <a href="{{ route('teachers.create') }}" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i class="fas fa-chalkboard-teacher text-green-700 dark:text-green-400 w-4 md:w-5 mr-3"></i>
                        <span class="text-gray-800 dark:text-gray-100 text-sm">New Teacher</span>
                    </a>
                    <a href="{{ route('marks.entry.form') }}" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i class="fas fa-edit text-purple-700 dark:text-purple-400 w-4 md:w-5 mr-3"></i>
                        <span class="text-gray-800 dark:text-gray-100 text-sm">Enter Marks</span>
                    </a>
                    <a href="{{ route('classes.create') }}" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i class="fas fa-chalkboard text-orange-700 dark:text-orange-400 w-4 md:w-5 mr-3"></i>
                        <span class="text-gray-800 dark:text-gray-100 text-sm">New Class</span>
                    </a>
                </div>
            </div>

            <!-- User dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center space-x-2 md:space-x-3 p-1 md:p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <!-- Avatar -->
                    <div class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-r from-maroon to-maroon-dark rounded-full flex items-center justify-center shadow-sm">
                        <span class="text-white font-bold text-xs md:text-sm">MA</span>
                    </div>
                    <!-- User info - Hidden on small screens -->
                    <div class="hidden lg:block text-left">
                        <span class="font-medium text-gray-800 dark:text-gray-100 text-sm">Matthew Amanyire</span>
                        <span class="text-xs text-gray-500 dark:text-gray-300 block">Administrator</span>
                    </div>
                    <i class="fas fa-chevron-down text-gray-600 dark:text-gray-400 text-xs md:text-sm hidden md:block"></i>
                </button>

                <div x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 py-2 z-50">
                    <!-- User Info -->
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-maroon to-maroon-dark rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">MA</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800 dark:text-gray-100 text-sm">Matthew Amanyire</p>
                                <p class="text-xs text-gray-500 dark:text-gray-300">admin@asms.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i class="fas fa-user text-gray-600 dark:text-gray-300 w-4 md:w-5 mr-3 text-sm"></i>
                        <span class="text-gray-800 dark:text-gray-100 text-sm">My Profile</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i class="fas fa-cog text-gray-600 dark:text-gray-300 w-4 md:w-5 mr-3 text-sm"></i>
                        <span class="text-gray-800 dark:text-gray-100 text-sm">Settings</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i class="fas fa-bell text-gray-600 dark:text-gray-300 w-4 md:w-5 mr-3 text-sm"></i>
                        <span class="text-gray-800 dark:text-gray-100 text-sm">Notifications</span>
                        <span class="ml-auto bg-red-600 text-white text-xs px-1.5 py-0.5 rounded-full">3</span>
                    </a>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-3 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors">
                            <i class="fas fa-sign-out-alt text-red-600 dark:text-red-400 w-4 md:w-5 mr-3 text-sm"></i>
                            <span class="font-medium text-sm text-red-600 dark:text-red-400">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
