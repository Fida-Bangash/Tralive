@extends('layouts.app')
@section('title', 'Add Student')
@section('page-title', 'Add New Student')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-plus-circle me-2"></i>Add New Student</h4>
    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
</div>

<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <div class="card-custom mb-4">
        <div class="card-header"><h6>Student Information</h6></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Roll Number <span class="text-danger">*</span></label>
                    <input type="text" name="roll_number" class="form-control" value="{{ old('roll_number') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Class <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select" required>
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }} {{ $class->section ? '- '.$class->section : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                    <select name="gender" class="form-select" required>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Parent/Guardian Name</label>
                    <input type="text" name="parent_name" class="form-control" value="{{ old('parent_name') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Parent Phone</label>
                    <input type="text" name="parent_phone" class="form-control" value="{{ old('parent_phone') }}">
                </div>
                <div class="col-md-8">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Admission Date</label>
                    <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary-custom btn-lg"><i class="fas fa-save me-2"></i>Save Student</button>
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-lg" style="border-radius: 10px;">Cancel</a>
    </div>
</form>
@endsection
