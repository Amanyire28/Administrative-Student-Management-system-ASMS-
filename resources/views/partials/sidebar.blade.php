<aside class="sidebar bg-maroon dark:bg-gray-800 border-r border-white/10 min-h-screen flex flex-col"
       x-data="sidebarData">

    <!-- Logo and Brand -->
    <div class="p-4 border-b border-white/10 dark:border-gray-700 sidebar-header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-white dark:bg-gray-700 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-maroon font-bold text-lg">AS</span>
            </div>
            <div class="sidebar-text" x-show="!sidebarCollapsed" x-transition>
                <h2 class="font-bold text-lg text-white">{{ config('app.name', 'ASMS') }}</h2>
                <p class="text-xs text-white/80">Academic School System</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu (Expanded Mode) -->
    <nav class="p-4 space-y-1 flex-1 sidebar-content" x-show="!sidebarCollapsed" x-transition>
        <!-- Dashboard -->
        <a href="/dashboard"
           @click="handleLinkClick()"
           :class="{
               'bg-white !text-maroon font-semibold': isExactActive('/dashboard'),
               'text-white/90 hover:bg-white/20': !isExactActive('/dashboard')
           }"
           class="nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200">
            <i class="fas fa-home w-5 text-center"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Students Dropdown -->
        <div class="relative">
            <button @click="toggleDropdown('students', $event)"
                :class="{
                    'bg-white !text-maroon font-semibold': isActive('/admin/students'),
                    'text-white/90 hover:bg-white/20': !isActive('/admin/students')
                }"
                class="nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span class="font-medium">Students</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                   :class="dropdowns.students ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="dropdowns.students"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 style="display: none;"
                 class="ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2">
                <a href="/admin/students"
                   @click="handleLinkClick()"
                   :class="{
                       'bg-white !text-maroon font-semibold': isExactActive('/admin/students'),
                       'text-white/90 hover:bg-white/20': !isExactActive('/admin/students')
                   }"
                   class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                    <i class="fas fa-list w-4 text-center"></i>
                    <span>All Students</span>
                </a>
                <a href="/admin/students/create"
                   @click="handleLinkClick()"
                   :class="{
                       'bg-white !text-maroon font-semibold': isExactActive('/admin/students/create'),
                       'text-white/90 hover:bg-white/20': !isExactActive('/admin/students/create')
                   }"
                   class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                    <i class="fas fa-user-plus w-4 text-center"></i>
                    <span>Add New</span>
                </a>
            </div>
        </div>

        <!-- Teachers Dropdown -->
        <div class="relative">
            <button @click="toggleDropdown('teachers', $event)"
                :class="{
                    'bg-white !text-maroon font-semibold': isActive('/admin/teachers'),
                    'text-white/90 hover:bg-white/20': !isActive('/admin/teachers')
                }"
                class="nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-chalkboard-teacher w-5 text-center"></i>
                    <span class="font-medium">Teachers</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                   :class="dropdowns.teachers ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="dropdowns.teachers" x-transition style="display: none;"
                 class="ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2">
                <a href="/admin/teachers"
                   @click="handleLinkClick()"
                   :class="{
                       'bg-white !text-maroon font-semibold': isExactActive('/admin/teachers'),
                       'text-white/90 hover:bg-white/20': !isExactActive('/admin/teachers')
                   }"
                   class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                    <i class="fas fa-list w-4 text-center"></i>
                    <span>All Teachers</span>
                </a>
                <a href="/admin/teachers/create"
                   @click="handleLinkClick()"
                   :class="{
                       'bg-white !text-maroon font-semibold': isExactActive('/admin/teachers/create'),
                       'text-white/90 hover:bg-white/20': !isExactActive('/admin/teachers/create')
                   }"
                   class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                    <i class="fas fa-user-plus w-4 text-center"></i>
                    <span>Add New</span>
                </a>
            </div>
        </div>

        <!-- Classes -->
        <a href="/admin/classes"
           @click="handleLinkClick()"
           :class="{
               'bg-white !text-maroon font-semibold': isActive('/admin/classes'),
               'text-white/90 hover:bg-white/20': !isActive('/admin/classes')
           }"
           class="nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200">
            <i class="fas fa-chalkboard w-5 text-center"></i>
            <span class="font-medium">Classes</span>
        </a>

        <!-- Subjects -->
        <a href="/admin/subjects"
           @click="handleLinkClick()"
           :class="{
               'bg-white !text-maroon font-semibold': isActive('/admin/subjects'),
               'text-white/90 hover:bg-white/20': !isActive('/admin/subjects')
           }"
           class="nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200">
            <i class="fas fa-book w-5 text-center"></i>
            <span class="font-medium">Subjects</span>
        </a>

        <!-- Marks Dropdown -->
        <div class="relative">
            <button @click="toggleDropdown('marks', $event)"
                :class="{
                    'bg-white !text-maroon font-semibold': isActive('/admin/marks'),
                    'text-white/90 hover:bg-white/20': !isActive('/admin/marks')
                }"
                class="nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-edit w-5 text-center"></i>
                    <span class="font-medium">Marks</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                   :class="dropdowns.marks ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="dropdowns.marks" x-transition style="display: none;"
                 class="ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2">
                <a href="/admin/marks-entry"
                   @click="handleLinkClick()"
                   :class="{
                       'bg-white !text-maroon font-semibold': isExactActive('/admin/marks-entry'),
                       'text-white/90 hover:bg-white/20': !isExactActive('/admin/marks-entry')
                   }"
                   class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                    <i class="fas fa-pen w-4 text-center"></i>
                    <span>Enter Marks</span>
                </a>
                <a href="/admin/marks"
                   @click="handleLinkClick()"
                   :class="{
                       'bg-white !text-maroon font-semibold': isExactActive('/admin/marks'),
                       'text-white/90 hover:bg-white/20': !isExactActive('/admin/marks')
                   }"
                   class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                    <i class="fas fa-list w-4 text-center"></i>
                    <span>View Marks</span>
                </a>
            </div>
        </div>

        <!-- Reports Dropdown -->
        <div class="relative">
            <button @click="toggleDropdown('reports', $event)"
                :class="{
                    'bg-white !text-maroon font-semibold': isActive('/admin/report-card'),
                    'text-white/90 hover:bg-white/20': !isActive('/admin/report-card')
                }"
                class="nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-file-alt w-5 text-center"></i>
                    <span class="font-medium">Reports</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200"
                   :class="dropdowns.reports ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="dropdowns.reports" x-transition style="display: none;"
                 class="ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2">
                <a href="/admin/report-card/form"
                   @click="handleLinkClick()"
                   :class="{
                       'bg-white !text-maroon font-semibold': isExactActive('/admin/report-card/form'),
                       'text-white/90 hover:bg-white/20': !isExactActive('/admin/report-card/form')
                   }"
                   class="flex items-center space-x-3 p-2 rounded text-sm transition-colors">
                    <i class="fas fa-graduation-cap w-4 text-center"></i>
                    <span>Report Cards</span>
                </a>
            </div>
        </div>

        <!-- Settings -->
        <a href="/admin/settings"
           @click="handleLinkClick()"
           :class="{
               'bg-white !text-maroon font-semibold': isActive('/admin/settings'),
               'text-white/90 hover:bg-white/20': !isActive('/admin/settings')
           }"
           class="nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200">
            <i class="fas fa-cog w-5 text-center"></i>
            <span class="font-medium">Settings</span>
        </a>
    </nav>

    <!-- Icons Only Menu (Collapsed Mode) - WITHOUT DROPDOWNS -->
    <nav class="p-2 space-y-1 flex-1 sidebar-icons" x-show="sidebarCollapsed" x-transition style="display: none;">
        <!-- Dashboard Icon -->
        <a href="/dashboard"
           @click="handleLinkClick()"
           :class="{'bg-white/30': isExactActive('/dashboard')}"
           class="nav-link-icon group relative flex justify-center p-3 rounded-lg transition-all text-white/90 hover:bg-white/20">
            <i class="fas fa-home text-xl"></i>
            <span class="sidebar-tooltip">Dashboard</span>
        </a>

        <!-- Students Icon - DIRECT LINK to index -->
        <a href="/admin/students"
           @click="handleLinkClick()"
           :class="{'bg-white/30': isActive('/admin/students')}"
           class="nav-link-icon group relative flex justify-center p-3 rounded-lg transition-all text-white/90 hover:bg-white/20">
            <i class="fas fa-users text-xl"></i>
            <span class="sidebar-tooltip">Students</span>
        </a>

        <!-- Teachers Icon - DIRECT LINK to index -->
        <a href="/admin/teachers"
           @click="handleLinkClick()"
           :class="{'bg-white/30': isActive('/admin/teachers')}"
           class="nav-link-icon group relative flex justify-center p-3 rounded-lg transition-all text-white/90 hover:bg-white/20">
            <i class="fas fa-chalkboard-teacher text-xl"></i>
            <span class="sidebar-tooltip">Teachers</span>
        </a>

        <!-- Classes Icon -->
        <a href="/admin/classes"
           @click="handleLinkClick()"
           :class="{'bg-white/30': isActive('/admin/classes')}"
           class="nav-link-icon group relative flex justify-center p-3 rounded-lg transition-all text-white/90 hover:bg-white/20">
            <i class="fas fa-chalkboard text-xl"></i>
            <span class="sidebar-tooltip">Classes</span>
        </a>

        <!-- Subjects Icon -->
        <a href="/admin/subjects"
           @click="handleLinkClick()"
           :class="{'bg-white/30': isActive('/admin/subjects')}"
           class="nav-link-icon group relative flex justify-center p-3 rounded-lg transition-all text-white/90 hover:bg-white/20">
            <i class="fas fa-book text-xl"></i>
            <span class="sidebar-tooltip">Subjects</span>
        </a>

        <!-- Marks Icon - DIRECT LINK to entry page -->
        <a href="/admin/marks-entry"
           @click="handleLinkClick()"
           :class="{'bg-white/30': isActive('/admin/marks-entry')}"
           class="nav-link-icon group relative flex justify-center p-3 rounded-lg transition-all text-white/90 hover:bg-white/20">
            <i class="fas fa-edit text-xl"></i>
            <span class="sidebar-tooltip">Marks</span>
        </a>

        <!-- Reports Icon - DIRECT LINK to form page -->
        <a href="/admin/report-card/form"
           @click="handleLinkClick()"
           :class="{'bg-white/30': isActive('/admin/report-card/form')}"
           class="nav-link-icon group relative flex justify-center p-3 rounded-lg transition-all text-white/90 hover:bg-white/20">
            <i class="fas fa-file-alt text-xl"></i>
            <span class="sidebar-tooltip">Reports</span>
        </a>

        <!-- Settings Icon -->
        <a href="/admin/settings"
           @click="handleLinkClick()"
           :class="{'bg-white/30': isActive('/admin/settings')}"
           class="nav-link-icon group relative flex justify-center p-3 rounded-lg transition-all text-white/90 hover:bg-white/20">
            <i class="fas fa-cog text-xl"></i>
            <span class="sidebar-tooltip">Settings</span>
        </a>
    </nav>

    <!-- Logout Button -->
    <div class="border-t border-white/10">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full p-4 hover:bg-white/20 text-white/90 transition-all"
                    :class="sidebarCollapsed ? 'justify-center' : 'space-x-3'">
                <i class="fas fa-sign-out-alt" :class="sidebarCollapsed ? 'text-xl' : 'w-5 text-center'"></i>
                <span class="font-medium" x-show="!sidebarCollapsed" x-transition>Logout</span>
            </button>
        </form>
    </div>
</aside>

<style>
    .sidebar {
        width: 256px;
        height: 100vh;
        overflow-y: auto;
        overflow-x: hidden;
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: linear-gradient(180deg, #800000 0%, #5f0000 100%) !important;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.2) transparent;
    }

    .sidebar.collapsed {
        width: 70px !important;
    }

    .sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
    }

    /* Maroon dark for dropdown backgrounds */
    .bg-maroon-dark {
        background-color: #5f0000 !important;
    }

    .dark .bg-maroon-dark {
        background-color: #1f2937 !important;
    }

    /* Tooltip for collapsed mode */
    .sidebar-tooltip {
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        margin-left: 0.5rem;
        padding: 0.5rem 0.75rem;
        background: #1f2937;
        color: white;
        font-size: 0.75rem;
        border-radius: 0.375rem;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s;
        z-index: 50;
    }

    .group:hover .sidebar-tooltip {
        opacity: 1;
    }

    /* Dark mode */
    .dark .sidebar {
        background: linear-gradient(180deg, #1f2937 0%, #111827 100%) !important;
    }

    /* Active state styling */
    .nav-link.bg-white i,
    .nav-link.bg-white span,
    .nav-link-icon.bg-white\/30 i {
        color: #800000 !important;
    }

    /* Smooth transitions */
    .nav-link, .nav-link-icon {
        transition: all 0.2s ease-in-out;
    }
</style>
