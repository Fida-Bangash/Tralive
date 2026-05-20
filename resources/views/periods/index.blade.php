@extends('layouts.app')
@section('title', 'Periods / Timetable')
@section('page-title', 'Periods / Timetable')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-clock me-2"></i>Periods / Timetable</h4>
    <a href="{{ route('periods.create') }}" class="btn btn-primary-custom"><i class="fas fa-plus me-2"></i>Add Period</a>
</div>

<div class="card-custom mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <select name="class_id" class="form-select">
                    <option value="">All Classes</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }} {{ $class->section ? '- '.$class->section : '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="teacher_id" class="form-select">
                    <option value="">All Teachers</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="day" class="form-select">
                    <option value="">All Days</option>
                    @foreach($days as $day)
                        <option value="{{ $day }}" {{ request('day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom"><i class="fas fa-filter me-1"></i>Filter</button>
                <a href="{{ route('periods.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card-custom">
    <div class="card-body p-0">
        @if($periods->count())
        <div class="table-responsive">
            <table class="table table-custom">
                <thead><tr><th>Day</th><th>Period</th><th>Time</th><th>Subject</th><th>Teacher</th><th>Class</th><th>Actions</th></tr></thead>
                <tbody>
                    @foreach($periods as $period)
                    <tr>
                        <td class="fw-semibold">{{ $period->day }}</td>
                        <td><span class="badge bg-primary rounded-pill">P{{ $period->period_number }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($period->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($period->end_time)->format('h:i A') }}</td>
                        <td>{{ $period->subject->name }}</td>
                        <td>{{ $period->teacher->name }}</td>
                        <td>{{ $period->schoolClass->name }} {{ $period->schoolClass->section ? '- '.$period->schoolClass->section : '' }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('periods.edit', $period) }}" class="btn btn-sm btn-outline-warning" style="border-radius: 8px;"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('periods.destroy', $period) }}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" style="border-radius: 8px;"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $periods->withQueryString()->links() }}</div>
        @else
        <div class="empty-state"><i class="fas fa-clock"></i><h5>No Periods Found</h5>
            <a href="{{ route('periods.create') }}" class="btn btn-primary-custom mt-2"><i class="fas fa-plus me-2"></i>Add Period</a>
        </div>
        @endif
    </div>
</div>
@endsection
