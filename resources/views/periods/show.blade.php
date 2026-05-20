@extends('layouts.app')
@section('title', 'Period Details')
@section('page-title', 'Period Details')

@section('content')
<div class="page-header">
    <h4><i class="fas fa-clock me-2"></i>Period Details</h4>
    <a href="{{ route('periods.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="fas fa-arrow-left me-1"></i>Back</a>
</div>

<div class="card-custom">
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="mb-3"><small class="text-muted">Day</small><div class="fw-bold fs-5">{{ $period->day }}</div></div>
                <div class="mb-3"><small class="text-muted">Period Number</small><div class="fw-bold fs-5">Period {{ $period->period_number }}</div></div>
                <div class="mb-3"><small class="text-muted">Time</small><div class="fw-medium">{{ \Carbon\Carbon::parse($period->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($period->end_time)->format('h:i A') }}</div></div>
            </div>
            <div class="col-md-6">
                <div class="mb-3"><small class="text-muted">Teacher</small><div class="fw-medium">{{ $period->teacher->name }}</div></div>
                <div class="mb-3"><small class="text-muted">Subject</small><div class="fw-medium">{{ $period->subject->name }}</div></div>
                <div class="mb-3"><small class="text-muted">Class</small><div class="fw-medium">{{ $period->schoolClass->name }} {{ $period->schoolClass->section ? '- '.$period->schoolClass->section : '' }}</div></div>
            </div>
        </div>
    </div>
</div>
@endsection
