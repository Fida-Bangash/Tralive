@extends('layouts.app')
@section('title', 'Attendance Detail')
@section('page-title', 'Attendance Detail')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-clipboard-check me-2"></i>Attendance Detail</h4>
    <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="fas fa-arrow-left me-1"></i>Back</a>
</div>

<div class="card-custom">
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="mb-3"><small class="text-muted">Student</small><div class="fw-bold fs-5">{{ $attendance->student->name ?? 'N/A' }}</div></div>
                <div class="mb-3"><small class="text-muted">Class</small><div class="fw-medium">{{ $attendance->schoolClass->name ?? 'N/A' }}</div></div>
                <div class="mb-3"><small class="text-muted">Date</small><div class="fw-medium">{{ $attendance->date->format('d M Y') }}</div></div>
            </div>
            <div class="col-md-6">
                <div class="mb-3"><small class="text-muted">Status</small><div><span class="badge-status badge-{{ $attendance->status }}">{{ ucfirst($attendance->status) }}</span></div></div>
                <div class="mb-3"><small class="text-muted">Subject</small><div class="fw-medium">{{ $attendance->subject->name ?? '-' }}</div></div>
                <div class="mb-3"><small class="text-muted">Teacher</small><div class="fw-medium">{{ $attendance->teacher->name ?? '-' }}</div></div>
                <div class="mb-3"><small class="text-muted">Remarks</small><div class="fw-medium">{{ $attendance->remarks ?? '-' }}</div></div>
            </div>
        </div>
    </div>
</div>
@endsection
