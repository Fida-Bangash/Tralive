@extends('layouts.app')
@section('title', 'Add Period')
@section('page-title', 'Add New Period')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-plus-circle me-2"></i>Add New Period</h4>
    <a href="{{ route('periods.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="fas fa-arrow-left me-1"></i>Back</a>
</div>

<form action="{{ route('periods.store') }}" method="POST">
    @csrf
    <div class="card-custom mb-4">
        <div class="card-header"><h6>Period Information</h6></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Teacher <span class="text-danger">*</span></label>
                    <select name="teacher_id" class="form-select" required>
                        <option value="">Select Teacher</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Subject <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-select" required>
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Class <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select" required>
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }} {{ $class->section ? '- '.$class->section : '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Day <span class="text-danger">*</span></label>
                    <select name="day" class="form-select" required>
                        @foreach($days as $day)
                            <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Period Number <span class="text-danger">*</span></label>
                    <input type="number" name="period_number" class="form-control" value="{{ old('period_number', 1) }}" min="1" max="10" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Start Time <span class="text-danger">*</span></label>
                    <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">End Time <span class="text-danger">*</span></label>
                    <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}" required>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary-custom btn-lg"><i class="fas fa-save me-2"></i>Save Period</button>
        <a href="{{ route('periods.index') }}" class="btn btn-outline-secondary btn-lg" style="border-radius: 10px;">Cancel</a>
    </div>
</form>
@endsection
