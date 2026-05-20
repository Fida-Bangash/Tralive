@extends('layouts.app')
@section('title', 'Subject Details')
@section('page-title', 'Subject Details')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-book me-2"></i>{{ $subject->name }} ({{ $subject->code }})</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-outline-warning" style="border-radius: 10px;"><i class="fas fa-edit me-1"></i>Edit</a>
        <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="fas fa-arrow-left me-1"></i>Back</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card-custom">
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="stat-icon mx-auto" style="width: 64px; height: 64px; font-size: 1.5rem; background: linear-gradient(135deg, #f59e0b, #fbbf24);">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
                <h5 class="text-center fw-bold">{{ $subject->name }}</h5>
                <p class="text-center text-muted">{{ $subject->code }}</p>
                <div class="text-center"><span class="badge-status {{ $subject->status === 'active' ? 'badge-active' : 'badge-inactive' }}">{{ ucfirst($subject->status) }}</span></div>
                @if($subject->description)
                <hr>
                <p class="text-muted" style="font-size: 0.9rem;">{{ $subject->description }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card-custom">
            <div class="card-header"><h6><i class="fas fa-chalkboard-teacher me-2"></i>Teachers Teaching This Subject</h6></div>
            <div class="card-body p-0">
                @if($teacherAssignments->count())
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead><tr><th>Teacher</th><th>Class</th><th>Action</th></tr></thead>
                        <tbody>
                            @foreach($teacherAssignments as $ta)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar" style="background: linear-gradient(135deg, #10b981, #34d399); width: 32px; height: 32px; font-size: 0.7rem;">{{ strtoupper(substr($ta->teacher->name, 0, 2)) }}</div>
                                        <span class="fw-semibold">{{ $ta->teacher->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $ta->schoolClass->name ?? 'N/A' }} {{ $ta->schoolClass->section ?? '' }}</td>
                                <td><a href="{{ route('teachers.show', $ta->teacher) }}" class="btn btn-sm btn-outline-info" style="border-radius: 8px;"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state py-4"><i class="fas fa-chalkboard-teacher"></i><p>No teachers assigned to this subject</p></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
