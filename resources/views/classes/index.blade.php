@extends('layouts.app')
@section('title', 'Classes')
@section('page-title', 'Classes')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-school me-2"></i>All Classes</h4>
    <a href="{{ route('classes.create') }}" class="btn btn-primary-custom"><i class="fas fa-plus me-2"></i>Add Class</a>
</div>

<div class="card-custom mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-6">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Search classes..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-6 d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="fas fa-filter me-1"></i>Filter</button>
                <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="row g-4">
    @forelse($classes as $class)
    <div class="col-md-4">
        <div class="card-custom h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $class->name }}</h5>
                        @if($class->section)<span class="text-muted">Section: {{ $class->section }}</span>@endif
                    </div>
                    <span class="badge-status {{ $class->status === 'active' ? 'badge-active' : 'badge-inactive' }}">{{ ucfirst($class->status) }}</span>
                </div>
                <div class="d-flex gap-4 mb-3">
                    <div><small class="text-muted d-block">Students</small><span class="fw-bold fs-5 text-primary">{{ $class->students_count }}</span></div>
                    <div><small class="text-muted d-block">Capacity</small><span class="fw-bold fs-5">{{ $class->capacity }}</span></div>
                    <div><small class="text-muted d-block">Room</small><span class="fw-bold">{{ $class->room_number ?? 'N/A' }}</span></div>
                </div>
                <div class="progress mb-3" style="height: 6px; border-radius: 3px;">
                    @php $pct = $class->capacity > 0 ? min(100, round(($class->students_count / $class->capacity) * 100)) : 0; @endphp
                    <div class="progress-bar" style="width: {{ $pct }}%; background: {{ $pct > 90 ? 'var(--danger)' : ($pct > 70 ? 'var(--warning)' : 'var(--success)') }};"></div>
                </div>
                <div class="d-flex gap-1">
                    <a href="{{ route('classes.show', $class) }}" class="btn btn-sm btn-outline-info" style="border-radius: 8px;"><i class="fas fa-eye me-1"></i>View</a>
                    <a href="{{ route('classes.edit', $class) }}" class="btn btn-sm btn-outline-warning" style="border-radius: 8px;"><i class="fas fa-edit me-1"></i>Edit</a>
                    <form action="{{ route('classes.destroy', $class) }}" method="POST" onsubmit="return confirm('Delete this class?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" style="border-radius: 8px;"><i class="fas fa-trash me-1"></i>Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card-custom">
            <div class="empty-state">
                <i class="fas fa-school"></i>
                <h5>No Classes Found</h5>
                <a href="{{ route('classes.create') }}" class="btn btn-primary-custom mt-2"><i class="fas fa-plus me-2"></i>Add Class</a>
            </div>
        </div>
    </div>
    @endforelse
</div>
<div class="mt-4">{{ $classes->withQueryString()->links() }}</div>
@endsection
