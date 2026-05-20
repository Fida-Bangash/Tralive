@extends('layouts.app')
@section('title', 'Mark Attendance')
@section('page-title', 'Mark Attendance')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-clipboard-check me-2"></i>Mark Attendance</h4>
</div>

<div class="card-custom mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('attendance.mark') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Select Class <span class="text-danger">*</span></label>
                <select name="class_id" class="form-select" required>
                    <option value="">Choose Class</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ $classId == $class->id ? 'selected' : '' }}>{{ $class->name }} {{ $class->section ? '- '.$class->section : '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Date <span class="text-danger">*</span></label>
                <input type="date" name="date" class="form-control" value="{{ $date }}" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary-custom"><i class="fas fa-users me-1"></i>Load Students</button>
            </div>
        </form>
    </div>
</div>

@if($students->count())
<form action="{{ route('attendance.store') }}" method="POST">
    @csrf
    <input type="hidden" name="class_id" value="{{ $classId }}">
    <input type="hidden" name="date" value="{{ $date }}">

    <div class="card-custom mb-4">
        <div class="card-body py-3">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Subject (Optional)</label>
                    <select name="subject_id" class="form-select">
                        <option value="">General Attendance</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Teacher (Optional)</label>
                    <select name="teacher_id" class="form-select">
                        <option value="">Select Teacher</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end gap-2">
                    <button type="button" class="btn btn-outline-success btn-sm" style="border-radius: 8px;" onclick="markAll('present')"><i class="fas fa-check me-1"></i>All Present</button>
                    <button type="button" class="btn btn-outline-danger btn-sm" style="border-radius: 8px;" onclick="markAll('absent')"><i class="fas fa-times me-1"></i>All Absent</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card-custom mb-4">
        <div class="card-header"><h6><i class="fas fa-user-graduate me-2"></i>Students ({{ $students->count() }})</h6></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead><tr><th>#</th><th>Student</th><th>Roll No</th><th>Status</th><th>Remarks</th></tr></thead>
                    <tbody>
                        @foreach($students as $i => $student)
                        @php $existing = $existingAttendance->get($student->id); @endphp
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <input type="hidden" name="attendance[{{ $i }}][student_id]" value="{{ $student->id }}">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar" style="background: linear-gradient(135deg, #4f46e5, #818cf8); width: 32px; height: 32px; font-size: 0.7rem;">{{ strtoupper(substr($student->name, 0, 2)) }}</div>
                                    <span class="fw-semibold">{{ $student->name }}</span>
                                </div>
                            </td>
                            <td>{{ $student->roll_number }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    @foreach(['present', 'absent', 'late', 'excused'] as $status)
                                    <div class="form-check">
                                        <input class="form-check-input attendance-radio" type="radio"
                                            name="attendance[{{ $i }}][status]" value="{{ $status }}"
                                            id="att_{{ $student->id }}_{{ $status }}"
                                            {{ ($existing ? $existing->status : 'present') == $status ? 'checked' : '' }}>
                                        <label class="form-check-label" for="att_{{ $student->id }}_{{ $status }}" style="font-size: 0.8rem;">
                                            {{ ucfirst($status) }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <input type="text" name="attendance[{{ $i }}][remarks]" class="form-control form-control-sm"
                                    value="{{ $existing->remarks ?? '' }}" placeholder="Optional" style="max-width: 150px;">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary-custom btn-lg"><i class="fas fa-save me-2"></i>Save Attendance</button>
</form>
@elseif($classId)
<div class="card-custom">
    <div class="empty-state"><i class="fas fa-user-graduate"></i><h5>No Active Students in This Class</h5></div>
</div>
@endif
@endsection

@section('scripts')
<script>
function markAll(status) {
    document.querySelectorAll('.attendance-radio').forEach(radio => {
        if (radio.value === status) radio.checked = true;
    });
}
</script>
@endsection
