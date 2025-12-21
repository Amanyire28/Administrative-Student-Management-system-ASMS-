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
                    </form>
                </li>
            </ul>
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