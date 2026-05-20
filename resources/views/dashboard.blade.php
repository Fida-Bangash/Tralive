@extends('layouts.app')
@section('title', 'Dashboard - School Attendance System')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Total Students</div>
                    <div class="stat-value mt-2">{{ $totalStudents }}</div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #4f46e5, #818cf8);">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Total Teachers</div>
                    <div class="stat-value mt-2">{{ $totalTeachers }}</div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #0ea5e9, #38bdf8);">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Total Classes</div>
                    <div class="stat-value mt-2">{{ $totalClasses }}</div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #34d399);">
                    <i class="fas fa-school"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-label">Total Subjects</div>
                    <div class="stat-value mt-2">{{ $totalSubjects }}</div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #fbbf24);">
                    <i class="fas fa-book"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-4 col-md-6">
        <div class="stat-card" style="border-left: 4px solid var(--success);">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(16,185,129,0.1); color: var(--success); width: 48px; height: 48px; font-size: 1.2rem;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="stat-label">Today Present</div>
                    <div class="stat-value mt-1" style="font-size: 1.5rem;">{{ $todayPresent }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="stat-card" style="border-left: 4px solid var(--danger);">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(239,68,68,0.1); color: var(--danger); width: 48px; height: 48px; font-size: 1.2rem;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <div class="stat-label">Today Absent</div>
                    <div class="stat-value mt-1" style="font-size: 1.5rem;">{{ $todayAbsent }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
        <div class="stat-card" style="border-left: 4px solid var(--warning);">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(245,158,11,0.1); color: var(--warning); width: 48px; height: 48px; font-size: 1.2rem;">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="stat-label">Today Late</div>
                    <div class="stat-value mt-1" style="font-size: 1.5rem;">{{ $todayLate }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-4">
        <div class="card-custom">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6><i class="fas fa-school me-2 text-primary"></i>Class-wise Students</h6>
            </div>
            <div class="card-body p-0">
                @if($classWiseStudents->count())
                    <div class="table-responsive">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th class="text-center">Students</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classWiseStudents as $class)
                                <tr>
                                    <td>
                                        <a href="{{ route('classes.show', $class) }}" class="text-decoration-none fw-semibold">
                                            {{ $class->name }}
                                            @if($class->section) <span class="text-muted">- {{ $class->section }}</span> @endif
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary rounded-pill">{{ $class->students_count }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state py-4">
                        <i class="fas fa-school"></i>
                        <p>No classes yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card-custom">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6><i class="fas fa-user-graduate me-2 text-info"></i>Recent Students</h6>
                <a href="{{ route('students.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">View All</a>
            </div>
            <div class="card-body p-0">
                @if($recentStudents->count())
                    @foreach($recentStudents as $student)
                    <div class="d-flex align-items-center gap-3 p-3 border-bottom">
                        <div class="avatar" style="background: linear-gradient(135deg, #4f46e5, #818cf8);">
                            {{ strtoupper(substr($student->name, 0, 2)) }}
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold" style="font-size: 0.9rem;">{{ $student->name }}</div>
                            <small class="text-muted">{{ $student->roll_number }} | {{ $student->schoolClass->name ?? 'N/A' }}</small>
                        </div>
                        <span class="badge-status {{ $student->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                            {{ ucfirst($student->status) }}
                        </span>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state py-4">
                        <i class="fas fa-user-graduate"></i>
                        <p>No students yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card-custom">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6><i class="fas fa-chalkboard-teacher me-2 text-success"></i>Recent Teachers</h6>
                <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">View All</a>
            </div>
            <div class="card-body p-0">
                @if($recentTeachers->count())
                    @foreach($recentTeachers as $teacher)
                    <div class="d-flex align-items-center gap-3 p-3 border-bottom">
                        <div class="avatar" style="background: linear-gradient(135deg, #10b981, #34d399);">
                            {{ strtoupper(substr($teacher->name, 0, 2)) }}
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold" style="font-size: 0.9rem;">{{ $teacher->name }}</div>
                            <small class="text-muted">{{ $teacher->employee_id }} | {{ $teacher->qualification ?? 'N/A' }}</small>
                        </div>
                        <span class="badge-status {{ $teacher->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                            {{ ucfirst($teacher->status) }}
                        </span>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state py-4">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>No teachers yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
