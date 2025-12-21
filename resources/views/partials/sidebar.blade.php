<div class="sidebar">
    <!-- Logo/Brand Section -->
    <div class="sidebar-header text-center py-3 border-bottom border-light border-opacity-25">
        <h5 class="text-white fw-bold mb-0">ASMS</h5>
        <small class="text-white-50">Student Management</small>
    </div>

    <!-- Dynamic User Profile -->
    <div class="sidebar-profile d-flex flex-column align-items-center py-3 border-bottom border-light border-opacity-25">
        <div class="avatar mb-2">
            {{ strtoupper(substr(auth()->user()->name ?? 'Admin', 0, 2)) }}
        </div>
        <div class="profile-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
        <div class="profile-role">{{ ucfirst(auth()->user()->role ?? 'admin') }}</div>
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