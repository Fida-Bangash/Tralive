@extends('layouts.app')
@section('title', 'Edit Teacher')
@section('page-title', 'Edit Teacher')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-edit me-2"></i>Edit Teacher: {{ $teacher->name }}</h4>
    <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
</div>

<form action="{{ route('teachers.update', $teacher) }}" method="POST">
    @csrf @method('PUT')
    <div class="card-custom mb-4">
        <div class="card-header"><h6>Personal Information</h6></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $teacher->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Employee ID <span class="text-danger">*</span></label>
                    <input type="text" name="employee_id" class="form-control" value="{{ old('employee_id', $teacher->employee_id) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $teacher->phone) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                    <select name="gender" class="form-select" required>
                        <option value="male" {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $teacher->gender) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Qualification</label>
                    <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $teacher->qualification) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Joining Date</label>
                    <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date', $teacher->joining_date?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-8">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2">{{ old('address', $teacher->address) }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $teacher->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card-custom mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6>Subject & Class Assignments</h6>
            <button type="button" class="btn btn-sm btn-primary-custom" onclick="addAssignment()">
                <i class="fas fa-plus me-1"></i>Add Assignment
            </button>
        </div>
        <div class="card-body">
            <div id="assignments-container">
                @foreach($teacherSubjects as $i => $ts)
                <div class="row g-3 assignment-row mb-3">
                    <div class="col-md-5">
                        <select name="subject_class[{{ $i }}][subject_id]" class="form-select">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $ts->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }} ({{ $subject->code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="subject_class[{{ $i }}][class_id]" class="form-select">
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ $ts->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }} {{ $class->section ? '- '.$class->section : '' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;" onclick="this.closest('.assignment-row').remove()">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary-custom btn-lg">
            <i class="fas fa-save me-2"></i>Update Teacher
        </button>
        <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary btn-lg" style="border-radius: 10px;">Cancel</a>
    </div>
</form>

@endsection

@section('scripts')
<script>
let assignmentIndex = {{ $teacherSubjects->count() }};
function addAssignment() {
    const container = document.getElementById('assignments-container');
    const subjects = @json($subjects);
    const classes = @json($classes);

    let subjectOptions = '<option value="">Select Subject</option>';
    subjects.forEach(s => { subjectOptions += `<option value="${s.id}">${s.name} (${s.code})</option>`; });

    let classOptions = '<option value="">Select Class</option>';
    classes.forEach(c => { classOptions += `<option value="${c.id}">${c.name} ${c.section ? '- '+c.section : ''}</option>`; });

    const html = `<div class="row g-3 assignment-row mb-3">
        <div class="col-md-5"><select name="subject_class[${assignmentIndex}][subject_id]" class="form-select">${subjectOptions}</select></div>
        <div class="col-md-5"><select name="subject_class[${assignmentIndex}][class_id]" class="form-select">${classOptions}</select></div>
        <div class="col-md-2 d-flex align-items-end"><button type="button" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;" onclick="this.closest('.assignment-row').remove()"><i class="fas fa-trash"></i></button></div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    assignmentIndex++;
}
</script>
@endsection
