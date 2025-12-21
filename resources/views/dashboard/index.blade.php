@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-4">
    <!-- Alert container for success/error messages -->
    <div id="alert-container"></div>

    <!-- Dashboard Section -->
    <div id="dashboard-section">
        <!-- Summary Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card text-center shadow-sm card-accent card-students">
                    <div class="card-body">
                        <h5>Total Students</h5>
                        <h2>1,245</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm card-accent card-teachers">
                    <div class="card-body">
                        <h5>Total Teachers</h5>
                        <h2>42</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm card-accent card-classes">
                    <div class="card-body">
                        <h5>Total Classes</h5>
                        <h2>12</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm card-accent card-subjects">
                    <div class="card-body">
                        <h5>Total Subjects</h5>
                        <h2>8</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Updates and Notices -->
        <div class="row g-3">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold bg-light">Recent Updates</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover recent-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Type</th>
                                        <th>Details</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>John Doe</td>
                                        <td><span class="badge bg-primary-light text-primary">New</span></td>
                                        <td>Registered for Form 3</td>
                                        <td>2025-09-24</td>
                                    </tr>
                                    <tr>
                                        <td>Jane Smith</td>
                                        <td><span class="badge bg-success-light text-success">Result</span></td>
                                        <td>Topper: Biology - 95%</td>
                                        <td>2025-09-20</td>
                                    </tr>
                                    <tr>
                                        <td>Robert Johnson</td>
                                        <td><span class="badge bg-warning-light text-warning">Pending</span></td>
                                        <td>Report card pending (Math)</td>
                                        <td>2025-09-18</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold bg-light d-flex justify-content-between align-items-center">
                        <span>Recent Announcements</span>
                        <a href="{{ route('announcements.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body">
                        @if($recentAnnouncements->count() > 0)
                            @foreach($recentAnnouncements as $announcement)
                                <div class="announcement-item mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="fw-bold mb-1">{{ Str::limit($announcement->title, 30) }}</h6>
                                        <span class="badge {{ $announcement->getPriorityBadgeClass() }} badge-sm">
                                            {{ ucfirst($announcement->priority) }}
                                        </span>
                                    </div>
                                    <p class="text-muted small mb-2">{{ Str::limit($announcement->content, 80) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge {{ $announcement->getTypeBadgeClass() }} badge-sm">
                                            {{ ucfirst($announcement->type) }}
                                        </span>
                                        <small class="text-muted">{{ $announcement->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-bullhorn fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No announcements yet</p>
                                <a href="{{ route('announcements.create') }}" class="btn btn-sm btn-primary mt-2">
                                    Create First Announcement
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection