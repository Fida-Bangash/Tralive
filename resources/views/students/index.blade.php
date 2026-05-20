@extends('layouts.app')
@section('title', 'Students - School Attendance System')
@section('page-title', 'Students')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-user-graduate me-2"></i>All Students (A-Z)</h4>
    <a href="{{ route('students.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i>Add Student
    </a>
</div>

<div class="card-custom mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Search by name, email, roll..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="class_id" class="form-select">
                    <option value="">All Classes</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }} {{ $class->section ? '- '.$class->section : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="fas fa-filter me-1"></i>Filter</button>
                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card-custom">
    <div class="card-body p-0">
        @if($students->count())
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Roll Number</th>
                        <th>Class</th>
                        <th>Parent</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar" style="background: linear-gradient(135deg, #4f46e5, #818cf8); width: 36px; height: 36px; font-size: 0.75rem;">
                                    {{ strtoupper(substr($student->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $student->name }}</div>
                                    <small class="text-muted">{{ $student->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td><span class="fw-medium">{{ $student->roll_number }}</span></td>
                        <td>{{ $student->schoolClass->name ?? 'N/A' }} {{ $student->schoolClass->section ? '- '.$student->schoolClass->section : '' }}</td>
                        <td>{{ $student->parent_name ?? '-' }}</td>
                        <td>{{ $student->phone ?? '-' }}</td>
                        <td>
                            <span class="badge-status {{ $student->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-info" style="border-radius: 8px;"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-warning" style="border-radius: 8px;"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Delete this student?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" style="border-radius: 8px;"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $students->withQueryString()->links() }}</div>
        @else
        <div class="empty-state">
            <i class="fas fa-user-graduate"></i>
            <h5>No Students Found</h5>
            <p>Add your first student to get started.</p>
            <a href="{{ route('students.create') }}" class="btn btn-primary-custom mt-2"><i class="fas fa-plus me-2"></i>Add Student</a>
        </div>
        @endif
    </div>
</div>
@endsection
