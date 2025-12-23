<!-- Mobile Sidebar Overlay -->
<div id="mobileSidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" onclick="closeMobileSidebar()"></div>

<!-- Mobile Sidebar -->
<div id="mobileSidebar" class="fixed top-0 left-0 h-full w-64 bg-maroon dark:bg-gray-800 border-r border-white/10 shadow-lg z-50 transform -translate-x-full transition-transform duration-300">
    <div class="p-4 h-full flex flex-col">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white dark:bg-gray-700 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-maroon font-bold text-lg">AS</span>
                </div>
                <div>
                    <p class="font-medium text-white">{{ config('app.name', 'ASMS') }}</p>
                    <p class="text-sm text-white/80">Academic School System</p>
                </div>
            </div>
            <button onclick="closeMobileSidebar()" class="text-white/90 hover:text-white p-2">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Mobile navigation links - Matching desktop structure -->
        <nav class="space-y-1 flex-1 overflow-y-auto">
            <!-- Dashboard -->
            <a href="/dashboard"
               data-spa-link
               class="mobile-nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 text-white/90 hover:bg-white/20 {{ request()->is('dashboard') ? 'bg-white !text-maroon' : '' }}">
                <i class="fas fa-home w-5 text-center"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- Students Dropdown -->
            <div class="relative mobile-dropdown">
                <button type="button"
                        class="mobile-dropdown-btn nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200 text-white/90 hover:bg-white/20 {{ request()->is('admin/students*') ? 'bg-white !text-maroon' : '' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span class="font-medium">Students</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform"></i>
                </button>

                <!-- Students Dropdown Menu -->
                <div class="mobile-dropdown-content ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2 hidden">
                    <a href="/admin/students"
                       data-spa-link
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors text-white/90 hover:bg-white/20 {{ request()->is('admin/students') && !request()->is('admin/students/create') ? 'bg-white !text-maroon' : '' }}">
                        <i class="fas fa-list w-4 text-center"></i>
                        <span>All Students</span>
                    </a>
                    <a href="/admin/students/create"
                       data-spa-link
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors text-white/90 hover:bg-white/20 {{ request()->is('admin/students/create') ? 'bg-white !text-maroon' : '' }}">
                        <i class="fas fa-user-plus w-4 text-center"></i>
                        <span>Add New</span>
                    </a>
                </div>
            </div>

            <!-- Teachers Dropdown -->
            <div class="relative mobile-dropdown">
                <button type="button"
                        class="mobile-dropdown-btn nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200 text-white/90 hover:bg-white/20 {{ request()->is('admin/teachers*') ? 'bg-white !text-maroon' : '' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-chalkboard-teacher w-5 text-center"></i>
                        <span class="font-medium">Teachers</span>
                    </div>
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
                    <i class="fas fa-chevron-down text-xs transition-transform"></i>
                </button>

                <!-- Marks Dropdown Menu -->
                <div class="mobile-dropdown-content ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2 hidden">
                    <a href="/admin/marks-entry"
                       data-spa-link
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors text-white/90 hover:bg-white/20 {{ request()->is('admin/marks-entry') ? 'bg-white !text-maroon' : '' }}">
                        <i class="fas fa-pen w-4 text-center"></i>
                        <span>Enter Marks</span>
                    </a>
                    <a href="/admin/marks"
                       data-spa-link
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors text-white/90 hover:bg-white/20 {{ request()->is('admin/marks') && !request()->is('admin/marks-entry') ? 'bg-white !text-maroon' : '' }}">
                        <i class="fas fa-list w-4 text-center"></i>
                        <span>View Marks</span>
                    </a>
                </div>
            </div>

            <!-- Reports Dropdown -->
            <div class="relative mobile-dropdown">
                <button type="button"
                        class="mobile-dropdown-btn nav-link flex items-center justify-between w-full p-3 rounded-lg transition-all duration-200 text-white/90 hover:bg-white/20 {{ request()->is('admin/report-card*') ? 'bg-white !text-maroon' : '' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-file-alt w-5 text-center"></i>
                        <span class="font-medium">Reports</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform"></i>
                </button>

                <!-- Reports Dropdown Menu -->
                <div class="mobile-dropdown-content ml-8 mt-1 space-y-1 bg-white/10 backdrop-blur-sm rounded-lg p-2 hidden">
                    <a href="/admin/report-card/form"
                       data-spa-link
                       class="flex items-center space-x-3 p-2 rounded text-sm transition-colors text-white/90 hover:bg-white/20 {{ request()->is('admin/report-card/form') ? 'bg-white !text-maroon' : '' }}">
                        <i class="fas fa-graduation-cap w-4 text-center"></i>
                        <span>Report Cards</span>
                    </a>
                </div>
            </div>

            <!-- Settings -->
            <a href="/admin/settings"
               data-spa-link
               class="mobile-nav-link flex items-center space-x-3 p-3 rounded-lg transition-all duration-200 text-white/90 hover:bg-white/20 {{ request()->is('admin/settings*') ? 'bg-white !text-maroon' : '' }}">
                <i class="fas fa-cog w-5 text-center"></i>
                <span class="font-medium">Settings</span>
            </a>
        </nav>

        <!-- Logout button at bottom -->
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

<!-- Mobile sidebar JavaScript with SPA integration -->
<script>
    function openMobileSidebar() {
        const overlay = document.getElementById('mobileSidebarOverlay');
        const sidebar = document.getElementById('mobileSidebar');
        if (overlay && sidebar) {
            overlay.classList.remove('hidden');
            sidebar.classList.remove('-translate-x-full');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeMobileSidebar() {
        const overlay = document.getElementById('mobileSidebarOverlay');
        const sidebar = document.getElementById('mobileSidebar');
        if (overlay && sidebar) {
            overlay.classList.add('hidden');
            sidebar.classList.add('-translate-x-full');
            document.body.style.overflow = 'auto';
        }
    }

    // Initialize mobile sidebar with SPA integration
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('mobileSidebarOverlay');
        const sidebar = document.getElementById('mobileSidebar');

        if (overlay && sidebar) {
            // Close when clicking on overlay
            overlay.addEventListener('click', closeMobileSidebar);

            // Handle dropdown toggles
            const dropdownButtons = sidebar.querySelectorAll('.mobile-dropdown-btn');
            dropdownButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dropdown = this.closest('.mobile-dropdown');
                    const content = dropdown.querySelector('.mobile-dropdown-content');
                    const icon = this.querySelector('.fa-chevron-down');

                    // Toggle current dropdown
                    content.classList.toggle('hidden');
                    icon.classList.toggle('rotate-180');

                    // Close other dropdowns
                    dropdownButtons.forEach(otherBtn => {
                        if (otherBtn !== this) {
                            const otherDropdown = otherBtn.closest('.mobile-dropdown');
                            const otherContent = otherDropdown.querySelector('.mobile-dropdown-content');
                            const otherIcon = otherBtn.querySelector('.fa-chevron-down');
                            otherContent.classList.add('hidden');
                            otherIcon.classList.remove('rotate-180');
                        }
                    });
                });
            });

            // Handle SPA navigation for mobile links
            const mobileLinks = sidebar.querySelectorAll('[data-spa-link]');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Use SPA navigation if available
                    if (window.router && typeof window.router.navigate === 'function') {
                        e.preventDefault();
                        const href = this.getAttribute('href');

                        // Close sidebar
                        closeMobileSidebar();

                        // Navigate via SPA
                        window.router.navigate(href);

                        // Update active states after navigation
                        setTimeout(() => updateMobileActiveStates(), 100);
                    } else {
                        // Fallback to regular navigation but still close sidebar
                        closeMobileSidebar();
                    }
                });
            });

            // Update active states based on current URL
            function updateMobileActiveStates() {
                const currentPath = window.location.pathname;

                // Remove all active classes
                const allLinks = sidebar.querySelectorAll('.mobile-nav-link, .mobile-dropdown-btn');
                allLinks.forEach(link => {
                    link.classList.remove('bg-white', '!text-maroon');
                    link.classList.add('text-white/90', 'hover:bg-white/20');
                });

                const dropdownContents = sidebar.querySelectorAll('.mobile-dropdown-content');
                dropdownContents.forEach(content => content.classList.add('hidden'));

                const dropdownIcons = sidebar.querySelectorAll('.mobile-dropdown-btn .fa-chevron-down');
                dropdownIcons.forEach(icon => icon.classList.remove('rotate-180'));

                // Find and activate current link
                const matchingLink = Array.from(mobileLinks).find(link => {
                    const href = link.getAttribute('href');
                    return href === currentPath || currentPath.startsWith(href + '/');
                });

                if (matchingLink) {
                    matchingLink.classList.add('bg-white', '!text-maroon');
                    matchingLink.classList.remove('text-white/90', 'hover:bg-white/20');

                    // If it's inside a dropdown, open the dropdown
                    const parentDropdown = matchingLink.closest('.mobile-dropdown');
                    if (parentDropdown) {
                        const content = parentDropdown.querySelector('.mobile-dropdown-content');
                        const icon = parentDropdown.querySelector('.fa-chevron-down');
                        if (content) content.classList.remove('hidden');
                        if (icon) icon.classList.add('rotate-180');
                    }
                }
            }

            // Initial active state update
            updateMobileActiveStates();

            // Listen for SPA navigation events
            window.addEventListener('spa:navigated', function(e) {
                setTimeout(updateMobileActiveStates, 50);
            });

            // Close sidebar when pressing escape
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeMobileSidebar();
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!sidebar.contains(e.target)) {
                    const dropdownContents = sidebar.querySelectorAll('.mobile-dropdown-content');
                    dropdownContents.forEach(content => content.classList.add('hidden'));

                    const dropdownIcons = sidebar.querySelectorAll('.mobile-dropdown-btn .fa-chevron-down');
                    dropdownIcons.forEach(icon => icon.classList.remove('rotate-180'));
                }
            });
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
