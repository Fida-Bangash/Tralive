@extends('layouts.app')
@section('title', 'Attendance Report')
@section('page-title', 'Attendance Report')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-chart-bar me-2"></i>Attendance Report</h4>
</div>

<div class="card-custom mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Select Class <span class="text-danger">*</span></label>
                <select name="class_id" class="form-select" required>
                    <option value="">Choose Class</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ $classId == $class->id ? 'selected' : '' }}>{{ $class->name }} {{ $class->section ? '- '.$class->section : '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Month</label>
                <input type="month" name="month" class="form-control" value="{{ $month }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary-custom"><i class="fas fa-chart-bar me-1"></i>Generate Report</button>
            </div>
        </form>
    </div>
</div>

@if($reportData->count())
<div class="card-custom">
    <div class="card-header">
        <h6><i class="fas fa-table me-2"></i>Monthly Attendance Report - {{ \Carbon\Carbon::parse($month.'-01')->format('F Y') }}</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th class="text-center">Present</th>
                        <th class="text-center">Absent</th>
                        <th class="text-center">Late</th>
                        <th class="text-center">Excused</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportData as $i => $data)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <a href="{{ route('students.show', $data['student']) }}" class="text-decoration-none fw-semibold">{{ $data['student']->name }}</a>
                        </td>
                        <td class="text-center"><span class="badge-status badge-present">{{ $data['present'] }}</span></td>
                        <td class="text-center"><span class="badge-status badge-absent">{{ $data['absent'] }}</span></td>
                        <td class="text-center"><span class="badge-status badge-late">{{ $data['late'] }}</span></td>
                        <td class="text-center"><span class="badge-status badge-excused">{{ $data['excused'] }}</span></td>
                        <td class="text-center fw-bold">{{ $data['total'] }}</td>
                        <td class="text-center">
                            @php $pct = $data['total'] > 0 ? round(($data['present'] / $data['total']) * 100, 1) : 0; @endphp
                            <div class="d-flex align-items-center gap-2 justify-content-center">
                                <div class="progress flex-grow-1" style="height: 6px; max-width: 80px;">
                                    <div class="progress-bar" style="width: {{ $pct }}%; background: {{ $pct >= 75 ? 'var(--success)' : ($pct >= 50 ? 'var(--warning)' : 'var(--danger)') }};"></div>
                                </div>
                                <span class="fw-bold" style="font-size: 0.85rem;">{{ $pct }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@elseif($classId)
<div class="card-custom"><div class="empty-state"><i class="fas fa-chart-bar"></i><h5>No attendance data for this period</h5></div></div>
@endif
@endsection
