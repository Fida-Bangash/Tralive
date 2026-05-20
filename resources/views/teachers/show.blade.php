@extends('layouts.app')
@section('title', 'Teacher Details')
@section('page-title', 'Teacher Details')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-user me-2"></i>{{ $teacher->name }}</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('teachers.schedule', $teacher) }}" class="btn btn-outline-primary" style="border-radius: 10px;">
            <i class="fas fa-calendar-alt me-1"></i>Schedule
        </a>
        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-outline-warning" style="border-radius: 10px;">
            <i class="fas fa-edit me-1"></i>Edit
        </a>
        <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card-custom">
            <div class="card-body text-center">
                <div class="avatar mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(135deg, #10b981, #34d399);">
                    {{ strtoupper(substr($teacher->name, 0, 2)) }}
                </div>
                <h5 class="fw-bold">{{ $teacher->name }}</h5>
                <p class="text-muted mb-2">{{ $teacher->employee_id }}</p>
                <span class="badge-status {{ $teacher->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                    {{ ucfirst($teacher->status) }}
                </span>
            </div>
            <div class="card-body border-top">
                <div class="mb-3"><small class="text-muted">Email</small><div class="fw-medium">{{ $teacher->email }}</div></div>
                <div class="mb-3"><small class="text-muted">Phone</small><div class="fw-medium">{{ $teacher->phone ?? '-' }}</div></div>
                <div class="mb-3"><small class="text-muted">Gender</small><div class="fw-medium">{{ ucfirst($teacher->gender) }}</div></div>
                <div class="mb-3"><small class="text-muted">Qualification</small><div class="fw-medium">{{ $teacher->qualification ?? '-' }}</div></div>
                <div class="mb-3"><small class="text-muted">Joining Date</small><div class="fw-medium">{{ $teacher->joining_date?->format('d M Y') ?? '-' }}</div></div>
                <div><small class="text-muted">Address</small><div class="fw-medium">{{ $teacher->address ?? '-' }}</div></div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card-custom mb-4">
            <div class="card-header"><h6><i class="fas fa-book me-2"></i>Assigned Subjects & Classes</h6></div>
            <div class="card-body p-0">
                @if($teacher->subjects->count())
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr><th>Subject</th><th>Class</th></tr>
                        </thead>
                        <tbody>
                            @foreach($teacher->subjects as $subject)
                            <tr>
                                <td class="fw-semibold">{{ $subject->name }}</td>
                                <td>
                                    @php
                                        $cls = \App\Models\SchoolClass::find($subject->pivot->class_id);
                                    @endphp
                                    {{ $cls ? $cls->name . ($cls->section ? ' - '.$cls->section : '') : 'N/A' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state py-4">
                    <i class="fas fa-book"></i>
                    <p>No subjects assigned yet</p>
                </div>
                @endif
            </div>
        </div>

        <div class="card-custom">
            <div class="card-header"><h6><i class="fas fa-clock me-2"></i>Today's Schedule</h6></div>
            <div class="card-body p-0">
                @php $today = now()->format('l'); @endphp
                @if(isset($schedule[$today]) && $schedule[$today]->count())
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr><th>Period</th><th>Subject</th><th>Class</th><th>Time</th></tr>
                        </thead>
                        <tbody>
                            @foreach($schedule[$today]->sortBy('period_number') as $period)
                            <tr>
                                <td><span class="badge bg-primary rounded-pill">{{ $period->period_number }}</span></td>
                                <td>{{ $period->subject->name }}</td>
                                <td>{{ $period->schoolClass->name }} {{ $period->schoolClass->section ? '- '.$period->schoolClass->section : '' }}</td>
                                <td>{{ \Carbon\Carbon::parse($period->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($period->end_time)->format('h:i A') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state py-4">
                    <i class="fas fa-calendar-check"></i>
                    <p>No periods scheduled for today</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
