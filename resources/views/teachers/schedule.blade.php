@extends('layouts.app')
@section('title', 'Teacher Schedule')
@section('page-title', 'Teacher Schedule')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-calendar-alt me-2"></i>{{ $teacher->name }}'s Schedule</h4>
    <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-outline-secondary" style="border-radius: 10px;">
        <i class="fas fa-arrow-left me-1"></i>Back to Profile
    </a>
</div>

<div class="card-custom">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th style="width: 120px;">Day</th>
                        <th>Periods</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($days as $day)
                    <tr>
                        <td>
                            <span class="fw-bold {{ $day === now()->format('l') ? 'text-primary' : '' }}">
                                {{ $day }}
                                @if($day === now()->format('l'))
                                    <span class="badge bg-primary ms-1" style="font-size: 0.6rem;">TODAY</span>
                                @endif
                            </span>
                        </td>
                        <td>
                            @if(isset($schedule[$day]) && $schedule[$day]->count())
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($schedule[$day]->sortBy('period_number') as $period)
                                    <div class="p-2 rounded-3" style="background: #f1f5f9; min-width: 180px;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-primary rounded-pill">P{{ $period->period_number }}</span>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($period->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($period->end_time)->format('h:i A') }}</small>
                                        </div>
                                        <div class="fw-semibold mt-1" style="font-size: 0.85rem;">{{ $period->subject->name }}</div>
                                        <small class="text-muted">{{ $period->schoolClass->name }} {{ $period->schoolClass->section ? '- '.$period->schoolClass->section : '' }}</small>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted fst-italic">No periods</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
