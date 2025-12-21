<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ASMS') - {{ config('app.name') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <style>
        /* Override styles to ensure maroon theme loads properly */
        :root {
            --primary: #800000;
            --primary-dark: #5f0000;
            --primary-light: #b34d4d;
            --primary-xxs: rgba(128,0,0,0.06);
        }
        
        /* Ensure sidebar uses maroon from style.css */
        .sidebar {
            background: #800000 !important;
            color: #ffffff !important;
        }
        
        /* Ensure cards use proper maroon accents */
        .card-accent {
            border-left: 6px solid #800000 !important;
        }
        
        .card-students,
        .card-teachers,
        .card-classes,
        .card-subjects {
            border-left: 6px solid #800000 !important;
            background: linear-gradient(135deg, rgba(128,0,0,0.06), rgba(255,255,255,0.92)) !important;
        }
        
        /* Navigation active states */
        .nav-link.active {
            background: rgba(255,255,255,0.16) !important;
            color: #ffffff !important;
        }
        
        .nav-link:hover {
            background: rgba(255,255,255,0.08) !important;
            color: #ffffff !important;
        }
        
        /* Navbar brand color */
        .navbar-brand {
            color: #800000 !important;
            font-weight: 600 !important;
        }
        
        /* Avatar styling */
        .avatar {
            background: #ffffff !important;
            color: #800000 !important;
        }
        
        /* Profile dropdown - solid background with proper z-index */
        .dropdown {
            position: relative !important;
            z-index: 1050 !important;
        }
        
        .dropdown-menu {
            background: #ffffff !important;
            opacity: 1 !important;
            border: 1px solid #dee2e6 !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
            z-index: 1051 !important;
            position: absolute !important;
        }
        
        .dropdown-item {
            color: #333 !important;
        }
        
        .dropdown-item:hover {
            background: #f8f9fa !important;
            color: #800000 !important;
        }
        
        /* Ensure navbar has proper z-index */
        .navbar {
            z-index: 1040 !important;
            position: relative !important;
        }
        
        /* Enhanced Sidebar Styling */
        .layout-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        
        .sidebar {
            width: 280px !important;
            height: 100vh !important;
            display: flex !important;
            flex-direction: column !important;
            overflow: hidden;
        }
        
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }
        
        /* Navbar should be fixed height */
        .navbar {
            flex-shrink: 0;
        }
        
        /* Content area should be scrollable */
        .content-area {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }
        
        .sidebar-header h5 {
            font-size: 1.25rem;
            letter-spacing: 1px;
        }
        
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
        }
        
        .nav-section-header {
            margin: 1rem 0 0.5rem 0;
            padding: 0 0.5rem;
        }
        
        .nav-section-header:first-child {
            margin-top: 0.5rem;
        }
        
        .nav-link {
            padding: 0.75rem 1rem !important;
            margin-bottom: 0.25rem !important;
            border-radius: 8px !important;
            color: rgba(255,255,255,0.9) !important;
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
        }
        
        .nav-link i {
            width: 20px;
            font-size: 0.9rem;
        }
        
        .nav-link:hover {
            background: rgba(255,255,255,0.1) !important;
            color: #ffffff !important;
            transform: translateX(4px) !important;
        }
        
        .nav-link.active {
            background: rgba(255,255,255,0.2) !important;
            color: #ffffff !important;
            font-weight: 600 !important;
        }
        
        .sub-link {
            padding: 0.5rem 1rem !important;
            font-size: 0.9rem !important;
            color: rgba(255,255,255,0.8) !important;
        }
        
        .sub-link:hover {
            background: rgba(255,255,255,0.08) !important;
            color: rgba(255,255,255,0.95) !important;
        }
        
        .sub-link.active {
            background: rgba(255,255,255,0.15) !important;
            color: #ffffff !important;
        }
        
        .quick-action {
            background: rgba(255,255,255,0.05) !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
        }
        
        .quick-action:hover {
            background: rgba(255,255,255,0.15) !important;
            border-color: rgba(255,255,255,0.2) !important;
        }
        
        .dropdown-toggle::after {
            margin-left: auto;
        }
        
        .avatar {
            width: 50px !important;
            height: 50px !important;
            font-size: 1rem !important;
            font-weight: 700 !important;
        }
        
        .profile-name {
            font-weight: 600 !important;
            font-size: 0.95rem !important;
            color: #ffffff !important;
        }
        
        .profile-role {
            font-size: 0.8rem !important;
            color: rgba(255,255,255,0.7) !important;
        }
        
        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .layout-container {
                position: relative !important;
                height: 100vh !important;
            }
            
            .sidebar {
                width: 280px !important;
                height: 100vh !important;
                position: fixed !important;
                top: 0 !important;
                left: -280px !important;
                z-index: 1060 !important;
                transition: left 0.3s ease !important;
                box-shadow: 2px 0 10px rgba(0,0,0,0.3) !important;
            }
            
            .sidebar.show {
                left: 0 !important;
            }
            
            .main-content {
                width: 100% !important;
                margin-left: 0 !important;
                height: 100vh !important;
            }
            
            .sidebar-overlay {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                background: rgba(0,0,0,0.5) !important;
                z-index: 1055 !important;
                opacity: 0 !important;
                visibility: hidden !important;
                transition: all 0.3s ease !important;
            }
            
            .sidebar-overlay.show {
                opacity: 1 !important;
                visibility: visible !important;
            }
        }
        
        @media (min-width: 769px) {
            .sidebar {
                position: relative !important;
                left: 0 !important;
            }
            
            .sidebar-overlay {
                display: none !important;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Layout Container -->
    <div class="layout-container">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @include('partials.navbar')

            <!-- Scrollable Page Content -->
            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            // Debug: Check if elements exist
            console.log('Sidebar elements found:', {
                toggle: !!sidebarToggle,
                close: !!sidebarClose,
                sidebar: !!sidebar,
                overlay: !!overlay
            });
            
            // Toggle sidebar
            function toggleSidebar() {
                if (sidebar && overlay) {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                    document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
                }
            }
            
            // Close sidebar
            function closeSidebar() {
                if (sidebar && overlay) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            }
            
            // Event listeners
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }
            
            if (sidebarClose) {
                sidebarClose.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    closeSidebar();
                });
            }
            
            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }
            
            // Close sidebar when clicking on nav links (mobile)
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        closeSidebar();
                    }
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    closeSidebar();
                }
            });
            
            // Handle escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && sidebar && sidebar.classList.contains('show')) {
                    closeSidebar();
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
