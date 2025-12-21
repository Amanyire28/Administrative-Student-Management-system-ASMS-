<div class="sidebar">
    <!-- Mobile Close Button -->
    <div class="d-md-none position-absolute top-0 end-0 p-3" style="z-index: 1061;">
        <button class="btn btn-link text-white p-0 border-0" 
                id="sidebarClose" 
                aria-label="Close sidebar"
                style="font-size: 1.2rem; background: none; box-shadow: none;">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <!-- Logo/Brand Section -->
    <div class="sidebar-header text-center py-3 border-bottom border-light border-opacity-25">
        <!-- Logo Icon -->
        <div class="logo-container mb-2">
            <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-1" 
                 style="width: 45px; height: 45px; background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1)); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3);">
                <i class="fas fa-graduation-cap text-white" style="font-size: 1.3rem;"></i>
            </div>
        </div>
        
        <!-- Brand Name -->
        <div class="brand-text">
            <h5 class="text-white fw-bold mb-1" style="letter-spacing: 2px; font-size: 1.2rem;">ASMS</h5>
            <small class="text-white-50 d-block" style="font-size: 0.75rem; letter-spacing: 0.4px; line-height: 1.2;">
                Administrative Student<br>Management System
            </small>
        </div>
    </div>
    
    <!-- Navigation Menu -->
    <div class="sidebar-nav px-3 py-2">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate me-2"></i>
                    <span>Students</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('classes.index') }}" class="nav-link {{ request()->routeIs('classes.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard me-2"></i>
                    <span>Classes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('subjects.index') }}" class="nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                    <i class="fas fa-book me-2"></i>
                    <span>Subjects</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('marks.index') }}" class="nav-link {{ request()->routeIs('marks.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line me-2"></i>
                    <span>Marks</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('announcements.index') }}" class="nav-link {{ request()->routeIs('announcements.*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn me-2"></i>
                    <span>Announcements</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt me-2"></i>
                    <span>Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('teachers.index') }}" class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    <span>Teachers</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Footer -->
    <div class="sidebar-footer mt-auto p-3 border-top border-light border-opacity-25">
        <div class="text-center">
            <small class="text-white-50">© 2025 ASMS v1.0</small>
        </div>
    </div>
</div>

<style>
/* Enhanced Logo Styling */
.sidebar-header {
    background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
    position: relative;
    overflow: hidden;
}

.sidebar-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.05) 0%, transparent 50%, rgba(255,255,255,0.02) 100%);
    pointer-events: none;
}

/* Logo Animation */
.logo-container .rounded-circle {
    transition: all 0.4s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.logo-container:hover .rounded-circle {
    transform: scale(1.1) rotate(10deg);
    box-shadow: 0 8px 25px rgba(255,255,255,0.3);
    background: linear-gradient(135deg, rgba(255,255,255,0.3), rgba(255,255,255,0.15)) !important;
}

.logo-container .fas {
    transition: all 0.3s ease;
}

.logo-container:hover .fas {
    transform: scale(1.1);
    text-shadow: 0 2px 8px rgba(255,255,255,0.5);
}

/* Brand Text Styling */
.brand-text h5 {
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}

.brand-text:hover h5 {
    transform: translateY(-2px);
    text-shadow: 0 4px 8px rgba(0,0,0,0.4);
}

.brand-text small {
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    opacity: 0.8;
}

.brand-text:hover small {
    opacity: 1;
    transform: translateY(-1px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar-header {
        padding: 0.75rem !important;
    }
    
    .logo-container .rounded-circle {
        width: 35px !important;
        height: 35px !important;
    }
    
    .logo-container .fas {
        font-size: 1rem !important;
    }
    
    .brand-text h5 {
        font-size: 1rem !important;
        letter-spacing: 1.5px !important;
    }
    
    .brand-text small {
        font-size: 0.7rem !important;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .sidebar-header {
        padding: 1rem !important;
    }
    
    .logo-container .rounded-circle {
        width: 40px !important;
        height: 40px !important;
    }
    
    .logo-container .fas {
        font-size: 1.2rem !important;
    }
    
    .brand-text h5 {
        font-size: 1.1rem !important;
    }
    
    .brand-text small {
        font-size: 0.72rem !important;
    }
}

/* Subtle glow effect */
.sidebar-header:hover .logo-container .rounded-circle {
    box-shadow: 0 0 20px rgba(255,255,255,0.4), 0 8px 25px rgba(255,255,255,0.3);
}

/* Enhanced visual hierarchy */
.sidebar-header .text-white {
    position: relative;
    z-index: 2;
}

.sidebar-header .text-white-50 {
    position: relative;
    z-index: 2;
}
</style>