@extends('layouts.app')
@section('title', 'Edit Class')
@section('page-title', 'Edit Class')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-edit me-2"></i>Edit: {{ $class->name }}</h4>
    <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="fas fa-arrow-left me-1"></i>Back</a>
</div>

<form action="{{ route('classes.update', $class) }}" method="POST">
    @csrf @method('PUT')
    <div class="card-custom mb-4">
        <div class="card-header"><h6>Class Information</h6></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Class Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $class->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Section</label>
                    <input type="text" name="section" class="form-control" value="{{ old('section', $class->section) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Room Number</label>
                    <input type="text" name="room_number" class="form-control" value="{{ old('room_number', $class->room_number) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Capacity <span class="text-danger">*</span></label>
                    <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $class->capacity) }}" min="1" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $class->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $class->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary-custom btn-lg"><i class="fas fa-save me-2"></i>Update Class</button>
        <a href="{{ route('classes.index') }}" class="btn btn-outline-secondary btn-lg" style="border-radius: 10px;">Cancel</a>
    </div>
</form>
@endsection
