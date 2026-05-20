@extends('layouts.app')
@section('title', 'Teachers - School Attendance System')
@section('page-title', 'Teachers')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-chalkboard-teacher me-2"></i>All Teachers</h4>
    <a href="{{ route('teachers.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i>Add Teacher
    </a>
</div>

<div class="card-custom mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-5">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Search by name, email, ID..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="fas fa-filter me-1"></i>Filter</button>
                <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card-custom">
    <div class="card-body p-0">
        @if($teachers->count())
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Teacher</th>
                        <th>Employee ID</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Qualification</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                    <tr>
                        <td>{{ $loop->iteration + ($teachers->currentPage() - 1) * $teachers->perPage() }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar" style="background: linear-gradient(135deg, #10b981, #34d399); width: 36px; height: 36px; font-size: 0.75rem;">
                                    {{ strtoupper(substr($teacher->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $teacher->name }}</div>
                                    <small class="text-muted">{{ ucfirst($teacher->gender) }}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="fw-medium">{{ $teacher->employee_id }}</span></td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone ?? '-' }}</td>
                        <td>{{ $teacher->qualification ?? '-' }}</td>
                        <td>
                            <span class="badge-status {{ $teacher->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                                {{ ucfirst($teacher->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-sm btn-outline-info" style="border-radius: 8px;" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('teachers.schedule', $teacher) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;" title="Schedule">
                                    <i class="fas fa-calendar-alt"></i>
                                </a>
                                <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-sm btn-outline-warning" style="border-radius: 8px;" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this teacher?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" style="border-radius: 8px;" title="Delete">
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
        <div class="p-3">{{ $teachers->withQueryString()->links() }}</div>
        @else
        <div class="empty-state">
            <i class="fas fa-chalkboard-teacher"></i>
            <h5>No Teachers Found</h5>
            <p>Add your first teacher to get started.</p>
            <a href="{{ route('teachers.create') }}" class="btn btn-primary-custom mt-2">
                <i class="fas fa-plus me-2"></i>Add Teacher
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
