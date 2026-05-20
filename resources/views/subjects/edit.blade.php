@extends('layouts.app')
@section('title', 'Edit Subject')
@section('page-title', 'Edit Subject')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-edit me-2"></i>Edit: {{ $subject->name }}</h4>
    <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="fas fa-arrow-left me-1"></i>Back</a>
</div>

<form action="{{ route('subjects.update', $subject) }}" method="POST">
    @csrf @method('PUT')
    <div class="card-custom mb-4">
        <div class="card-header"><h6>Subject Information</h6></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Subject Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $subject->name) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Subject Code <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control" value="{{ old('code', $subject->code) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $subject->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $subject->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $subject->description) }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary-custom btn-lg"><i class="fas fa-save me-2"></i>Update Subject</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary btn-lg" style="border-radius: 10px;">Cancel</a>
    </div>
</form>
@endsection
