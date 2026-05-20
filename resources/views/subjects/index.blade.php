@extends('layouts.app')
@section('title', 'Subjects')
@section('page-title', 'Subjects')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-book me-2"></i>All Subjects</h4>
    <a href="{{ route('subjects.create') }}" class="btn btn-primary-custom"><i class="fas fa-plus me-2"></i>Add Subject</a>
</div>

<div class="card-custom mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-6">
                <div class="search-box"><i class="fas fa-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Search subjects..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-6 d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="fas fa-filter me-1"></i>Filter</button>
                <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card-custom">
    <div class="card-body p-0">
        @if($subjects->count())
        <div class="table-responsive">
            <table class="table table-custom">
                <thead><tr><th>#</th><th>Subject</th><th>Code</th><th>Description</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $loop->iteration + ($subjects->currentPage() - 1) * $subjects->perPage() }}</td>
                        <td class="fw-semibold">{{ $subject->name }}</td>
                        <td><span class="badge bg-light text-dark">{{ $subject->code }}</span></td>
                        <td>{{ Str::limit($subject->description, 50) ?? '-' }}</td>
                        <td><span class="badge-status {{ $subject->status === 'active' ? 'badge-active' : 'badge-inactive' }}">{{ ucfirst($subject->status) }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('subjects.show', $subject) }}" class="btn btn-sm btn-outline-info" style="border-radius: 8px;"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-outline-warning" style="border-radius: 8px;"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('subjects.destroy', $subject) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" style="border-radius: 8px;"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $subjects->withQueryString()->links() }}</div>
        @else
        <div class="empty-state"><i class="fas fa-book"></i><h5>No Subjects Found</h5>
            <a href="{{ route('subjects.create') }}" class="btn btn-primary-custom mt-2"><i class="fas fa-plus me-2"></i>Add Subject</a>
        </div>
        @endif
    </div>
</div>
@endsection
