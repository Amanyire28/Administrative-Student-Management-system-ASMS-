<!-- Mobile Sidebar Overlay -->

<div id="mobileSidebarOverlay"
     class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"
     @click="$store.mobileSidebar.close()"></div>

<!-- Mobile Sidebar with Alpine.js -->
<div id="mobileSidebar"
     x-data="sidebarData"
     class="fixed top-0 left-0 h-full w-64 bg-maroon dark:bg-gray-800 border-r border-white/10 shadow-lg z-50 transform -translate-x-full transition-transform duration-300">
    <div class="p-4 h-full flex flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white dark:bg-gray-700 rounded-full flex items-center justify-center flex-shrink-0">
                     <img
                src="{{ asset('storage/' . school_setting('school_logo')) }}"
                alt="{{ school_setting('school_name') }}"
                class="w-full h-full rounded-full"
            >

                </div>
                <div>
                    <p class="font-medium text-white">{{ config('app.name', 'ASMS') }}</p>
                    <p class="text-sm text-white/80">Academic School System</p>
                </div>
            </div>

            <button @click="$store.mobileSidebar.close()" class="text-white/90 hover:text-white p-2">


                <i class="fas fa-times text-lg"></i>
            </button>
        </div>


        <!-- Mobile navigation links - WITH PERMISSIONS AND ALPINE.JS -->
        <nav class="space-y-1 flex-1 overflow-y-auto">
            <!-- Dashboard (Everyone) -->
            <a href="/dashboard"
               @click="handleLinkClick()"
               :class="{
                   'bg-white !text-maroon': isExactActive('/dashboard'),
                   'text-white/90 hover:bg-white/20': !isExactActive('/dashboard')
               }"
               class="mobile-nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200">

                <i class="fas fa-home w-5 text-center"></i>
                <span class="font-medium">Dashboard</span>
            </a>


            <!-- Students Dropdown (Only if has permission) -->
            @can('students.view')
            <div class="relative mobile-dropdown">
                <button type="button"
                        @click="toggleDropdown('students', $event)"
                        :class="{
                            'bg-white !text-maroon': isActive('/admin/students'),
                            'text-white/90 hover:bg-white/20': !isActive('/admin/students')
                        }"
                        class="mobile-dropdown-btn nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200">

                    <div class="flex items-center space-x-3">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span class="font-medium">Students</span>
                    </div>

                    <i class="fas fa-chevron-down text-xs transition-transform"
                       :class="dropdowns.students ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="dropdowns.students"
                     x-transition
                     style="display: none;"
                     class="mobile-dropdown-content ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2">
                    @can('students.view')
                    <a href="/admin/students"
                       @click="handleLinkClick()"
                       :class="{
                           'bg-white !text-maroon': isExactActive('/admin/students'),
                           'text-white/90 hover:bg-white/20': !isExactActive('/admin/students')
                       }"
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                        <i class="fas fa-list w-4 text-center"></i>
                        <span>All Students</span>
                    </a>
                    @endcan

                    @can('students.create')
                    <a href="/admin/students/create"
                       @click="handleLinkClick()"
                       :class="{
                           'bg-white !text-maroon': isExactActive('/admin/students/create'),
                           'text-white/90 hover:bg-white/20': !isExactActive('/admin/students/create')
                       }"
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                        <i class="fas fa-user-plus w-4 text-center"></i>
                        <span>Add New</span>
                    </a>
                    @endcan
                </div>
            </div>
            @endcan

            <!-- Teachers Dropdown (Only if has permission) -->
            @can('teachers.view')
            <div class="relative mobile-dropdown">
                <button type="button"
                        @click="toggleDropdown('teachers', $event)"
                        :class="{
                            'bg-white !text-maroon': isActive('/admin/teachers'),
                            'text-white/90 hover:bg-white/20': !isActive('/admin/teachers')
                        }"
                        class="mobile-dropdown-btn nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200">

                    <div class="flex items-center space-x-3">
                        <i class="fas fa-chalkboard-teacher w-5 text-center"></i>
                        <span class="font-medium">Teachers</span>
                    </div>

                    <i class="fas fa-chevron-down text-xs transition-transform"
                       :class="dropdowns.teachers ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="dropdowns.teachers"
                     x-transition
                     style="display: none;"
                     class="mobile-dropdown-content ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2">
                    @can('teachers.view')
                    <a href="/admin/teachers"
                       @click="handleLinkClick()"
                       :class="{
                           'bg-white !text-maroon': isExactActive('/admin/teachers'),
                           'text-white/90 hover:bg-white/20': !isExactActive('/admin/teachers')
                       }"
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                        <i class="fas fa-list w-4 text-center"></i>
                        <span>All Teachers</span>
                    </a>
                    @endcan

                    @can('teachers.create')
                    <a href="/admin/teachers/create"
                       @click="handleLinkClick()"
                       :class="{
                           'bg-white !text-maroon': isExactActive('/admin/teachers/create'),
                           'text-white/90 hover:bg-white/20': !isExactActive('/admin/teachers/create')
                       }"
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                        <i class="fas fa-user-plus w-4 text-center"></i>
                        <span>Add New</span>
                    </a>
                    @endcan
                </div>
            </div>
            @endcan

            <!-- Classes (Only if has permission) -->
            @can('classes.view')
            <a href="/admin/classes"
               @click="handleLinkClick()"
               :class="{
                   'bg-white !text-maroon': isActive('/admin/classes'),
                   'text-white/90 hover:bg-white/20': !isActive('/admin/classes')
               }"
               class="mobile-nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200">
                <i class="fas fa-chalkboard w-5 text-center"></i>
                <span class="font-medium">Classes</span>
            </a>
            @endcan

            <!-- Subjects (Only if has permission) -->
            @can('subjects.view')
            <a href="/admin/subjects"
               @click="handleLinkClick()"
               :class="{
                   'bg-white !text-maroon': isActive('/admin/subjects'),
                   'text-white/90 hover:bg-white/20': !isActive('/admin/subjects')
               }"
               class="mobile-nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200">
                <i class="fas fa-book w-5 text-center"></i>
                <span class="font-medium">Subjects</span>
            </a>
            @endcan

            <!-- Marks Dropdown (Only if has permission) -->
            @canany(['marks.view', 'marks.entry'])
            <div class="relative mobile-dropdown">
                <button type="button"
                        @click="toggleDropdown('marks', $event)"
                        :class="{
                            'bg-white !text-maroon': isActive('/admin/marks'),
                            'text-white/90 hover:bg-white/20': !isActive('/admin/marks')
                        }"
                        class="mobile-dropdown-btn nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200">

                    <i class="fas fa-chevron-down text-xs transition-transform"></i>
                </button>

                <!-- Teachers Dropdown Menu -->
                <div class="mobile-dropdown-content ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2 hidden">
                    <a href="/admin/teachers"
                       data-spa-link
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors text-white/90 hover:bg-white/20 {{ request()->is('admin/teachers') && !request()->is('admin/teachers/create') ? 'bg-white !text-maroon' : '' }}">
                        <i class="fas fa-list w-4 text-center"></i>
                        <span>All Teachers</span>
                    </a>
                    <a href="/admin/teachers/create"
                       data-spa-link
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors text-white/90 hover:bg-white/20 {{ request()->is('admin/teachers/create') ? 'bg-white !text-maroon' : '' }}">
                        <i class="fas fa-user-plus w-4 text-center"></i>
                        <span>Add New</span>
                    </a>
                </div>
            </div>

            <!-- Classes -->
            <a href="/admin/classes"
               data-spa-link
               class="mobile-nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 text-white/90 hover:bg-white/20 {{ request()->is('admin/classes*') ? 'bg-white !text-maroon' : '' }}">
                <i class="fas fa-chalkboard w-5 text-center"></i>
                <span class="font-medium">Classes</span>
            </a>

            <!-- Subjects -->
            <a href="/admin/subjects"
               data-spa-link
               class="mobile-nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 text-white/90 hover:bg-white/20 {{ request()->is('admin/subjects*') ? 'bg-white !text-maroon' : '' }}">
                <i class="fas fa-book w-5 text-center"></i>
                <span class="font-medium">Subjects</span>
            </a>

            <!-- Marks Dropdown -->
            <div class="relative mobile-dropdown">
                <button type="button"
                        class="mobile-dropdown-btn nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200 text-white/90 hover:bg-white/20 {{ request()->is('admin/marks*') ? 'bg-white !text-maroon' : '' }}">

                    <div class="flex items-center space-x-3">
                        <i class="fas fa-edit w-5 text-center"></i>
                        <span class="font-medium">Marks</span>
                    </div>

                    <i class="fas fa-chevron-down text-xs transition-transform"
                       :class="dropdowns.marks ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="dropdowns.marks"
                     x-transition
                     style="display: none;"
                     class="mobile-dropdown-content ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2">
                    @can('marks.entry')
                    <a href="/admin/marks-entry"
                       @click="handleLinkClick()"
                       :class="{
                           'bg-white !text-maroon': isExactActive('/admin/marks-entry'),
                           'text-white/90 hover:bg-white/20': !isExactActive('/admin/marks-entry')
                       }"
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                        <i class="fas fa-pen w-4 text-center"></i>
                        <span>Enter Marks</span>
                    </a>
                    @endcan

                    @can('marks.view')
                    <a href="/admin/marks"
                       @click="handleLinkClick()"
                       :class="{
                           'bg-white !text-maroon': isExactActive('/admin/marks'),
                           'text-white/90 hover:bg-white/20': !isExactActive('/admin/marks')
                       }"
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                        <i class="fas fa-list w-4 text-center"></i>
                        <span>View Marks</span>
                    </a>
                    @endcan
                </div>
            </div>
            @endcanany

            <!-- Reports Dropdown (Only if has permission) -->
            @can('reports.view')
            <div class="relative mobile-dropdown">
                <button type="button"
                        @click="toggleDropdown('reports', $event)"
                        :class="{
                            'bg-white !text-maroon': isActive('/admin/report-card'),
                            'text-white/90 hover:bg-white/20': !isActive('/admin/report-card')
                        }"
                        class="mobile-dropdown-btn nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200">

                    <div class="flex items-center space-x-3">
                        <i class="fas fa-file-alt w-5 text-center"></i>
                        <span class="font-medium">Reports</span>
                    </div>

                    <i class="fas fa-chevron-down text-xs transition-transform"
                       :class="dropdowns.reports ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="dropdowns.reports"
                     x-transition
                     style="display: none;"
                     class="mobile-dropdown-content ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2">
                    @can('reports.view')
                    <a href="/admin/report-card/form"
                       @click="handleLinkClick()"
                       :class="{
                           'bg-white !text-maroon': isExactActive('/admin/report-card/form'),
                           'text-white/90 hover:bg-white/20': !isExactActive('/admin/report-card/form')
                       }"
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                        <i class="fas fa-graduation-cap w-4 text-center"></i>
                        <span>Report Cards</span>
                    </a>
                    @endcan
                </div>
            </div>
            @endcan

            <!-- Settings (Only Super Admin) -->
           <!-- Settings (System Management) - MOBILE -->
@canany(['system.users', 'system.roles'])
<a href="/admin/system"
   @click="handleLinkClick()"
   :class="{
       'bg-white !text-maroon': isActive('/admin/system'),
       'text-white/90 hover:bg-white/20': !isActive('/admin/system')
   }"
   class="mobile-nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200">
    <i class="fas fa-cog w-5 text-center"></i>
    <span class="font-medium">Settings</span>
</a>
@endcanany
        </nav>

        <!-- Logout button at bottom (Everyone) -->

        <div class="pt-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center space-x-3 w-full p-3 rounded-lg hover:bg-white/20 text-white/90">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>


<!-- Alpine.js Store for Mobile Sidebar -->
<script>
    // Create Alpine.js store for mobile sidebar (if not exists)
    document.addEventListener('alpine:init', () => {
        if (!Alpine.store('mobileSidebar')) {
            Alpine.store('mobileSidebar', {
                isOpen: false,

                open() {
                    this.isOpen = true;
                    const overlay = document.getElementById('mobileSidebarOverlay');
                    const sidebar = document.getElementById('mobileSidebar');
                    if (overlay && sidebar) {
                        overlay.classList.remove('hidden');
                        sidebar.classList.remove('-translate-x-full');
                        document.body.style.overflow = 'hidden';
                    }
                },

                close() {
                    this.isOpen = false;
                    const overlay = document.getElementById('mobileSidebarOverlay');
                    const sidebar = document.getElementById('mobileSidebar');
                    if (overlay && sidebar) {
                        overlay.classList.add('hidden');
                        sidebar.classList.add('-translate-x-full');
                        document.body.style.overflow = 'auto';
                    }
                }
            });
        }
    });

    // Global functions for backward compatibility
    function openMobileSidebar() {
        if (window.Alpine && Alpine.store('mobileSidebar')) {
            Alpine.store('mobileSidebar').open();

        }
    }

    function closeMobileSidebar() {

        if (window.Alpine && Alpine.store('mobileSidebar')) {
            Alpine.store('mobileSidebar').close();
        }
    }

    // Close on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeMobileSidebar();

        }
    });
</script>

<style>
    /* Mobile sidebar specific styles */
    #mobileSidebar {
        background: linear-gradient(180deg, #800000 0%, #5f0000 100%) !important;
    }

    .dark #mobileSidebar {
        background: linear-gradient(180deg, #1f2937 0%, #111827 100%) !important;
    }

    /* Active state styling */
    .mobile-nav-link.bg-white i,
    .mobile-nav-link.bg-white span,
    .mobile-dropdown-btn.bg-white i,
    .mobile-dropdown-btn.bg-white span {
        color: #800000 !important;
    }

    /* Dropdown animation */
    .mobile-dropdown-content {
        transition: all 0.2s ease-in-out;
    }

    .fa-chevron-down.rotate-180 {
        transform: rotate(180deg);
    }

    /* Smooth scrolling for mobile sidebar */
    #mobileSidebar nav {
        -webkit-overflow-scrolling: touch;
    }

    #mobileSidebar nav::-webkit-scrollbar {
        width: 4px;
    }

    #mobileSidebar nav::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
    }

    #mobileSidebar nav::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 4px;
    }

    /* Animation for mobile sidebar */
    #mobileSidebar {
        transition: transform 0.3s ease-in-out;
    }

    #mobileSidebarOverlay {
        transition: opacity 0.3s ease-in-out;
    }
</style>
