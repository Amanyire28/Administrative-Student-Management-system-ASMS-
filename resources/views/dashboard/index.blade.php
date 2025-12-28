@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-4">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
                <div class="welcome-section mb-3 mb-lg-0">
                    <h2 class="fw-bold mb-1 welcome-title" style="color: #8B0000;">
                        Welcome back, {{ auth()->user()->name ?? 'System Administrator' }}!
                    </h2>
                    <p class="mb-0 welcome-subtitle" style="color: #666;">
                        Here's what's happening at your school today.
                    </p>
                </div>
                <div class="text-start text-lg-end">
                    <small class="text-muted">{{ now()->format('l, F j, Y') }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm card-accent card-students">
                <div class="card-body">
                    <i class="fas fa-user-graduate fa-2x mb-3" style="color: #8B0000;"></i>
                    <h5>Total Students</h5>
                    <h2>{{ number_format($totalStudents) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm card-accent card-teachers">
                <div class="card-body">
                    <i class="fas fa-chalkboard-teacher fa-2x mb-3" style="color: #8B0000;"></i>
                    <h5>Total Teachers</h5>
                    <h2>{{ number_format($totalTeachers) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm card-accent card-classes">
                <div class="card-body">
                    <i class="fas fa-chalkboard fa-2x mb-3" style="color: #8B0000;"></i>
                    <h5>Total Classes</h5>
                    <h2>{{ number_format($totalClasses) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm card-accent card-subjects">
                <div class="card-body">
                    <i class="fas fa-book fa-2x mb-3" style="color: #8B0000;"></i>
                    <h5>Total Subjects</h5>
                    <h2>{{ number_format($totalSubjects) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row g-3 mb-4">
        <!-- Recent Announcements -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Recent Announcements</h5>
                    <a href="{{ route('announcements.index') }}" class="btn btn-sm btn-outline-primary" style="border-color: #8B0000; color: #8B0000;">View All</a>
                </div>
                <div class="card-body">
                    @if($recentAnnouncements->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentAnnouncements as $announcement)
                                <div class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="d-flex align-items-start flex-grow-1">
                                            <div class="avatar-sm bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="background-color: rgba(139, 0, 0, 0.1);">
                                                <i class="fas fa-bullhorn" style="color: #8B0000;"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <h6 class="fw-bold mb-1">{{ $announcement->title }}</h6>
                                                    <span class="badge {{ $announcement->getTypeBadgeClass() }} badge-sm ms-2">
                                                        {{ ucfirst($announcement->type) }}
                                                    </span>
                                                </div>
                                                <p class="mb-2 text-muted">{{ Str::limit($announcement->content, 150) }}</p>
                                                <small class="text-muted">{{ $announcement->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-bullhorn fa-3x mb-3" style="color: #8B0000;"></i>
                            <h6 class="text-muted">No announcements yet</h6>
                            <p class="text-muted small">Create your first announcement to get started.</p>
                            <a href="{{ route('announcements.create') }}" class="btn btn-sm btn-primary mt-2" style="background-color: #8B0000; border-color: #8B0000;">
                                Create First Announcement
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <h6 class="fw-bold mb-0">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-6">
                            <a href="{{ route('students.create') }}" class="btn btn-outline-primary w-100 d-flex flex-column align-items-center justify-content-center py-3 text-decoration-none" style="border-color: #8B0000; color: #8B0000;">
                                <i class="fas fa-user-plus fa-lg mb-2" style="color: #8B0000;"></i>
                                <span class="small">Add Student</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('marks.entry.form') }}" class="btn btn-outline-success w-100 d-flex flex-column align-items-center justify-content-center py-3 text-decoration-none" style="border-color: #8B0000; color: #8B0000;">
                                <i class="fas fa-edit fa-lg mb-2" style="color: #8B0000;"></i>
                                <span class="small">Enter Marks</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('reports.create') }}" class="btn btn-outline-info w-100 d-flex flex-column align-items-center justify-content-center py-3 text-decoration-none" style="border-color: #8B0000; color: #8B0000;">
                                <i class="fas fa-file-alt fa-lg mb-2" style="color: #8B0000;"></i>
                                <span class="small">Generate Report</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('teachers.create') }}" class="btn btn-outline-warning w-100 d-flex flex-column align-items-center justify-content-center py-3 text-decoration-none" style="border-color: #8B0000; color: #8B0000;">
                                <i class="fas fa-user-tie fa-lg mb-2" style="color: #8B0000;"></i>
                                <span class="small">Add Teacher</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('classes.create') }}" class="btn btn-outline-secondary w-100 d-flex flex-column align-items-center justify-content-center py-3 text-decoration-none" style="border-color: #8B0000; color: #8B0000;">
                                <i class="fas fa-plus-circle fa-lg mb-2" style="color: #8B0000;"></i>
                                <span class="small">Add Class</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('announcements.create') }}" class="btn btn-outline-danger w-100 d-flex flex-column align-items-center justify-content-center py-3 text-decoration-none" style="border-color: #8B0000; color: #8B0000;">
                                <i class="fas fa-bullhorn fa-lg mb-2" style="color: #8B0000;"></i>
                                <span class="small">New Notice</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Recent Activities</h5>
                    <a href="{{ route('marks.index') }}" class="btn btn-sm btn-outline-primary" style="border-color: #8B0000; color: #8B0000;">View All</a>
                </div>
                <div class="card-body">
                    @if($recentActivities->count() > 0)
                        <div class="row g-3">
                            @foreach($recentActivities as $activity)
                                <div class="col-md-4 col-lg-3">
                                    <div class="card border-0 h-100" style="background-color: rgba(139, 0, 0, 0.05);">
                                        <div class="card-body p-3">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="avatar-sm bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="background-color: rgba(139, 0, 0, 0.1); min-width: 35px; height: 35px;">
                                                    <i class="fas fa-chart-line small" style="color: #8B0000;"></i>
                                                </div>
                                                <h6 class="mb-0 fw-bold small">{{ $activity->student->name }}</h6>
                                            </div>
                                            <p class="mb-2 text-muted small">
                                                <strong>{{ $activity->subject->name }}</strong><br>
                                                Score: {{ $activity->marks_obtained }}/{{ $activity->total_marks }}
                                                <span class="badge bg-light text-dark ms-1">
                                                    {{ number_format(($activity->marks_obtained / $activity->total_marks) * 100, 1) }}%
                                                </span>
                                            </p>
                                            <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-line fa-3x mb-3" style="color: #8B0000;"></i>
                            <h6 class="text-muted">No recent activities</h6>
                            <p class="text-muted small">Start entering marks to see activities here.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-sm {
    width: 40px;
    height: 40px;
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.btn:hover {
    transform: translateY(-1px);
}

/* Maroon theme hover effects */
.btn[style*="border-color: #8B0000"]:hover {
    background-color: #8B0000 !important;
    color: white !important;
}

.btn[style*="border-color: #8B0000"]:hover i {
    color: white !important;
}

/* Welcome Section Responsive Styling */
.welcome-section {
    transition: all 0.3s ease;
}

.welcome-title {
    font-size: 2rem;
    text-shadow: 0 2px 4px rgba(139, 0, 0, 0.1);
    transition: all 0.3s ease;
    color: #8B0000 !important;
}

.welcome-subtitle {
    font-size: 1rem;
    transition: all 0.3s ease;
    color: #666 !important;
}

.welcome-section:hover .welcome-title {
    transform: translateY(-2px);
    text-shadow: 0 4px 8px rgba(139, 0, 0, 0.2);
}

.welcome-section:hover .welcome-subtitle {
    color: #333 !important;
    transform: translateY(-1px);
}

/* Responsive Design */
@media (max-width: 576px) {
    .welcome-title {
        font-size: 1.5rem !important;
        line-height: 1.3;
    }
    
    .welcome-subtitle {
        font-size: 0.9rem !important;
        line-height: 1.4;
    }
}

@media (min-width: 577px) and (max-width: 768px) {
    .welcome-title {
        font-size: 1.75rem !important;
        line-height: 1.3;
    }
    
    .welcome-subtitle {
        font-size: 0.95rem !important;
    }
}

@media (min-width: 769px) and (max-width: 992px) {
    .welcome-title {
        font-size: 1.9rem !important;
    }
    
    .welcome-subtitle {
        font-size: 0.98rem !important;
    }
}

@media (min-width: 993px) {
    .welcome-title {
        font-size: 2rem !important;
    }
    
    .welcome-subtitle {
        font-size: 1rem !important;
    }
}

/* Welcome title maroon styling */
.welcome-title {
    color: #8B0000 !important;
}

.welcome-subtitle {
    color: #666 !important;
}
</style>
@endsection
