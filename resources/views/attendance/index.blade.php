@extends('layouts.app')
@section('title', 'Attendance Records')
@section('page-title', 'Attendance Records')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-list-check me-2"></i>Attendance Records</h4>
    <a href="{{ route('attendance.mark') }}" class="btn btn-primary-custom"><i class="fas fa-clipboard-check me-2"></i>Mark Attendance</a>
</div>

<div class="card-custom mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Class</label>
                <select name="class_id" class="form-select">
                    <option value="">All Classes</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }} {{ $class->section ? '- '.$class->section : '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                    <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                    <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                    <option value="excused" {{ request('status') == 'excused' ? 'selected' : '' }}>Excused</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="fas fa-filter me-1"></i>Filter</button>
                <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card-custom">
    <div class="card-body p-0">
        @if($attendances->count())
        <div class="table-responsive">
            <table class="table table-custom">
                <thead><tr><th>Date</th><th>Student</th><th>Class</th><th>Subject</th><th>Teacher</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @foreach($attendances as $att)
                    <tr>
                        <td>{{ $att->date->format('d M Y') }}</td>
                        <td class="fw-semibold">{{ $att->student->name ?? 'N/A' }}</td>
                        <td>{{ $att->schoolClass->name ?? 'N/A' }}</td>
                        <td>{{ $att->subject->name ?? '-' }}</td>
                        <td>{{ $att->teacher->name ?? '-' }}</td>
                        <td><span class="badge-status badge-{{ $att->status }}">{{ ucfirst($att->status) }}</span></td>
                        <td>
                            <form action="{{ route('attendance.destroy', $att) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" style="border-radius: 8px;"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $attendances->withQueryString()->links() }}</div>
        @else
        <div class="empty-state"><i class="fas fa-clipboard-list"></i><h5>No Attendance Records</h5>
            <a href="{{ route('attendance.mark') }}" class="btn btn-primary-custom mt-2"><i class="fas fa-clipboard-check me-2"></i>Mark Attendance</a>
        </div>
        @endif
    </div>
</div>
@endsection
