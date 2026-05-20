@extends('layouts.app')
@section('title', 'Class Details')
@section('page-title', 'Class Details')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-school me-2"></i>{{ $class->name }} {{ $class->section ? '- '.$class->section : '' }}</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('classes.edit', $class) }}" class="btn btn-outline-warning" style="border-radius: 10px;"><i class="fas fa-edit me-1"></i>Edit</a>
        <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="fas fa-arrow-left me-1"></i>Back</a>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card text-center"><div class="stat-value" style="font-size: 1.5rem;">{{ $class->students->count() }}</div><div class="stat-label">Students</div></div>
    </div>
    <div class="col-md-3">
        <div class="stat-card text-center"><div class="stat-value" style="font-size: 1.5rem;">{{ $class->capacity }}</div><div class="stat-label">Capacity</div></div>
    </div>
    <div class="col-md-3">
        <div class="stat-card text-center"><div class="stat-value" style="font-size: 1.5rem;">{{ $class->room_number ?? '-' }}</div><div class="stat-label">Room</div></div>
    </div>
    <div class="col-md-3">
        <div class="stat-card text-center"><div class="stat-value" style="font-size: 1.5rem;">{{ $teacherAssignments->count() }}</div><div class="stat-label">Teachers</div></div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card-custom">
            <div class="card-header"><h6><i class="fas fa-chalkboard-teacher me-2"></i>Teacher Assignments</h6></div>
            <div class="card-body p-0">
                @if($teacherAssignments->count())
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead><tr><th>Teacher</th><th>Subject</th></tr></thead>
                        <tbody>
                            @foreach($teacherAssignments as $ta)
                            <tr>
                                <td>
                                    <a href="{{ route('teachers.show', $ta->teacher) }}" class="text-decoration-none fw-semibold">{{ $ta->teacher->name }}</a>
                                </td>
                                <td>{{ $ta->subject->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state py-4"><i class="fas fa-chalkboard-teacher"></i><p>No teachers assigned</p></div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-custom">
            <div class="card-header"><h6><i class="fas fa-clock me-2"></i>Timetable</h6></div>
            <div class="card-body p-0">
                @if($class->periods->count())
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead><tr><th>Day</th><th>Period</th><th>Subject</th><th>Teacher</th><th>Time</th></tr></thead>
                        <tbody>
                            @foreach($days as $day)
                                @if(isset($schedule[$day]))
                                    @foreach($schedule[$day]->sortBy('period_number') as $p)
                                    <tr>
                                        <td class="fw-semibold">{{ $loop->first ? $day : '' }}</td>
                                        <td><span class="badge bg-primary rounded-pill">P{{ $p->period_number }}</span></td>
                                        <td>{{ $p->subject->name }}</td>
                                        <td>{{ $p->teacher->name }}</td>
                                        <td><small>{{ \Carbon\Carbon::parse($p->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($p->end_time)->format('h:i A') }}</small></td>
                                    </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state py-4"><i class="fas fa-clock"></i><p>No periods scheduled</p></div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card-custom mt-4">
    <div class="card-header"><h6><i class="fas fa-user-graduate me-2"></i>Students in this Class (A-Z)</h6></div>
    <div class="card-body p-0">
        @if($class->students->count())
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead><tr><th>#</th><th>Student</th><th>Roll Number</th><th>Email</th><th>Parent</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @foreach($class->students as $i => $student)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar" style="background: linear-gradient(135deg, #4f46e5, #818cf8); width: 32px; height: 32px; font-size: 0.7rem;">{{ strtoupper(substr($student->name, 0, 2)) }}</div>
                                <span class="fw-semibold">{{ $student->name }}</span>
                            </div>
                        </td>
                        <td>{{ $student->roll_number }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->parent_name ?? '-' }}</td>
                        <td><span class="badge-status {{ $student->status === 'active' ? 'badge-active' : 'badge-inactive' }}">{{ ucfirst($student->status) }}</span></td>
                        <td><a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-info" style="border-radius: 8px;"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="empty-state py-4"><i class="fas fa-user-graduate"></i><p>No students in this class</p></div>
        @endif
    </div>
</div>
@endsection
