@extends('layouts.app')
@section('title', 'Add Subject')
@section('page-title', 'Add New Subject')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-plus-circle me-2"></i>Add New Subject</h4>
    <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="fas fa-arrow-left me-1"></i>Back</a>
</div>

<form action="{{ route('subjects.store') }}" method="POST">
    @csrf
    <div class="card-custom mb-4">
        <div class="card-header"><h6>Subject Information</h6></div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Subject Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="e.g. Mathematics" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Subject Code <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder="e.g. MATH101" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Brief description...">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary-custom btn-lg"><i class="fas fa-save me-2"></i>Save Subject</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary btn-lg" style="border-radius: 10px;">Cancel</a>
    </div>
</form>
@endsection
