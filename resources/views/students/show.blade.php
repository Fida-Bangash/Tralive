@extends('layouts.app')
@section('title', 'Student Details')
@section('page-title', 'Student Details')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-user-graduate me-2"></i>{{ $student->name }}</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('students.edit', $student) }}" class="btn btn-outline-warning" style="border-radius: 10px;"><i class="fas fa-edit me-1"></i>Edit</a>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="fas fa-arrow-left me-1"></i>Back</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card-custom">
            <div class="card-body text-center">
                <div class="avatar mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(135deg, #4f46e5, #818cf8);">
                    {{ strtoupper(substr($student->name, 0, 2)) }}
                </div>
                <h5 class="fw-bold">{{ $student->name }}</h5>
                <p class="text-muted mb-2">{{ $student->roll_number }}</p>
                <span class="badge-status {{ $student->status === 'active' ? 'badge-active' : 'badge-inactive' }}">{{ ucfirst($student->status) }}</span>
            </div>
            <div class="card-body border-top">
                <div class="mb-3"><small class="text-muted">Class</small><div class="fw-medium">{{ $student->schoolClass->name ?? 'N/A' }} {{ $student->schoolClass->section ?? '' }}</div></div>
                <div class="mb-3"><small class="text-muted">Email</small><div class="fw-medium">{{ $student->email }}</div></div>
                <div class="mb-3"><small class="text-muted">Phone</small><div class="fw-medium">{{ $student->phone ?? '-' }}</div></div>
                <div class="mb-3"><small class="text-muted">Gender</small><div class="fw-medium">{{ ucfirst($student->gender) }}</div></div>
                <div class="mb-3"><small class="text-muted">Date of Birth</small><div class="fw-medium">{{ $student->date_of_birth?->format('d M Y') ?? '-' }}</div></div>
                <div class="mb-3"><small class="text-muted">Parent/Guardian</small><div class="fw-medium">{{ $student->parent_name ?? '-' }} {{ $student->parent_phone ? '('.$student->parent_phone.')' : '' }}</div></div>
                <div class="mb-3"><small class="text-muted">Admission Date</small><div class="fw-medium">{{ $student->admission_date?->format('d M Y') ?? '-' }}</div></div>
                <div><small class="text-muted">Address</small><div class="fw-medium">{{ $student->address ?? '-' }}</div></div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card text-center" style="border-left: 4px solid var(--primary);">
                    <div class="stat-value" style="font-size: 1.5rem;">{{ $attendancePercentage }}%</div>
                    <div class="stat-label">Attendance</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center" style="border-left: 4px solid var(--success);">
                    <div class="stat-value" style="font-size: 1.5rem; color: var(--success);">{{ $presentDays }}</div>
                    <div class="stat-label">Present</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center" style="border-left: 4px solid var(--danger);">
                    <div class="stat-value" style="font-size: 1.5rem; color: var(--danger);">{{ $absentDays }}</div>
                    <div class="stat-label">Absent</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center" style="border-left: 4px solid var(--warning);">
                    <div class="stat-value" style="font-size: 1.5rem; color: var(--warning);">{{ $lateDays }}</div>
                    <div class="stat-label">Late</div>
                </div>
            </div>
        </div>

        <div class="card-custom">
            <div class="card-header"><h6><i class="fas fa-history me-2"></i>Recent Attendance (Last 30 records)</h6></div>
            <div class="card-body p-0">
                @if($student->attendances->count())
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead><tr><th>Date</th><th>Subject</th><th>Teacher</th><th>Status</th><th>Remarks</th></tr></thead>
                        <tbody>
                            @foreach($student->attendances as $att)
                            <tr>
                                <td>{{ $att->date->format('d M Y') }}</td>
                                <td>{{ $att->subject->name ?? '-' }}</td>
                                <td>{{ $att->teacher->name ?? '-' }}</td>
                                <td><span class="badge-status badge-{{ $att->status }}">{{ ucfirst($att->status) }}</span></td>
                                <td>{{ $att->remarks ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state py-4"><i class="fas fa-clipboard-list"></i><p>No attendance records yet</p></div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
