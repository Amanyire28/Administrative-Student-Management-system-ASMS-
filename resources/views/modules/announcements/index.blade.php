@extends('layouts.app')

@section('title', 'Announcements')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark">Announcements</h2>
                <a href="{{ route('announcements.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>New Announcement
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    @if($announcements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Expires</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($announcements as $announcement)
                                        <tr>
                                            <td>
                                                <div class="fw-bold">{{ $announcement->title }}</div>
                                                <small class="text-muted">{{ Str::limit($announcement->content, 50) }}</small>
                                            </td>
                                            <td>
                                                <span class="badge {{ $announcement->getTypeBadgeClass() }}">
                                                    {{ ucfirst($announcement->type) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $announcement->getPriorityBadgeClass() }}">
                                                    {{ ucfirst($announcement->priority) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($announcement->is_active && !$announcement->isExpired())
                                                    <span class="badge bg-success">Active</span>
                                                @elseif($announcement->isExpired())
                                                    <span class="badge bg-secondary">Expired</span>
                                                @else
                                                    <span class="badge bg-warning">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $announcement->creator->name }}</td>
                                            <td>
                                                {{ $announcement->expires_at ? $announcement->expires_at->format('M d, Y') : 'Never' }}
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('announcements.show', $announcement) }}" 
                                                       class="btn btn-sm btn-outline-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('announcements.edit', $announcement) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('announcements.toggle', $announcement) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-outline-{{ $announcement->is_active ? 'warning' : 'success' }}"
                                                                title="{{ $announcement->is_active ? 'Deactivate' : 'Activate' }}">
                                                            <i class="fas fa-{{ $announcement->is_active ? 'pause' : 'play' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('announcements.destroy', $announcement) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this announcement?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $announcements->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-bullhorn fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No announcements found</h5>
                            <p class="text-muted">Create your first announcement to get started.</p>
                            <a href="{{ route('announcements.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Create Announcement
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection