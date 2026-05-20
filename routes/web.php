<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('teachers', TeacherController::class);
Route::get('teachers/{teacher}/schedule', [TeacherController::class, 'schedule'])->name('teachers.schedule');

Route::resource('students', StudentController::class);
Route::resource('classes', ClassController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('periods', PeriodController::class);

Route::resource('attendance', AttendanceController::class);
Route::get('attendance-mark', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
Route::get('attendance-report', [AttendanceController::class, 'report'])->name('attendance.report');
Route::get('api/students-by-class', [AttendanceController::class, 'getStudentsByClass'])->name('api.students-by-class');
