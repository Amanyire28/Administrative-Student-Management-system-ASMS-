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
            <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                Students
            </a>
        </li>
        <li class="nav-item dropdown-sub">
            <a href="#" class="nav-link" aria-haspopup="true" aria-expanded="false">
                Academic <span class="caret">▾</span>
            </a>
            <ul class="dropdown-submenu list-unstyled" role="menu">
                <li>
                    <a href="{{ route('classes.index') }}" class="nav-link sub-link {{ request()->routeIs('classes.*') ? 'active' : '' }}" role="menuitem">
                        <svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M3 6l9-4 9 4v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6z" fill="currentColor"/>
                        </svg>
                        Classes
                    </a>
                </li>
                <li>
                    <a href="{{ route('subjects.index') }}" class="nav-link sub-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}" role="menuitem">
                        <svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M3 7h18v2H3V7zm0 6h18v2H3v-2z" fill="currentColor"/>
                        </svg>
                        Subjects
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('marks.index') }}" class="nav-link {{ request()->routeIs('marks.*') ? 'active' : '' }}">
                Marks
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('teachers.index') }}" class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                Teachers
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('marks.entry.form') }}" class="nav-link {{ request()->routeIs('marks.entry*') ? 'active' : '' }}">
                Enter Marks
            </a>
        </li>
    </ul>
</div>