@extends('layouts.app')
@section('title', 'Edit Attendance')
@section('page-title', 'Edit Attendance')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-edit me-2"></i>Edit Attendance</h4>
    <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="fas fa-arrow-left me-1"></i>Back</a>
</div>

<form action="{{ route('attendance.update', $attendance) }}" method="POST">
    @csrf @method('PUT')
    <div class="card-custom mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        @foreach(['present', 'absent', 'late', 'excused'] as $status)
                            <option value="{{ $status }}" {{ old('status', $attendance->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Remarks</label>
                    <input type="text" name="remarks" class="form-control" value="{{ old('remarks', $attendance->remarks) }}">
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary-custom btn-lg"><i class="fas fa-save me-2"></i>Update</button>
        <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary btn-lg" style="border-radius: 10px;">Cancel</a>
    </div>
</form>
@endsection
