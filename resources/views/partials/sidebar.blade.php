<div class="sidebar p-3">
    <div class="sidebar-profile d-flex flex-column align-items-center mb-3">
        <div class="avatar" aria-hidden="true">MA</div>
        <div class="profile-name mt-2">Mathew Amanyire</div>
        <div class="profile-role">Administrator</div>
    </div>
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Students</a>
        </li>
        <li class="nav-item dropdown-sub">
            <a href="#" class="nav-link" aria-haspopup="true" aria-expanded="false">
                Classes <span class="caret">▾</span>
            </a>
            <ul class="dropdown-submenu list-unstyled" role="menu">
                <li>
                    <a href="#" class="nav-link sub-link" role="menuitem">
                        <svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M3 6l9-4 9 4v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6z" fill="currentColor"/>
                        </svg>
                        Classes Module
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link sub-link" role="menuitem">
                        <svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M3 7h18v2H3V7zm0 6h18v2H3v-2z" fill="currentColor"/>
                        </svg>
                        Subjects Module
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Marks</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Teachers</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Reports</a>
        </li>
    </ul>
</div>