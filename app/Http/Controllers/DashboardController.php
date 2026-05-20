<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::where('status', 'active')->count();
        $totalTeachers = Teacher::where('status', 'active')->count();
        $totalClasses = SchoolClass::where('status', 'active')->count();
        $totalSubjects = Subject::where('status', 'active')->count();

        $todayAttendance = Attendance::where('date', today())->get();
        $todayPresent = $todayAttendance->where('status', 'present')->count();
        $todayAbsent = $todayAttendance->where('status', 'absent')->count();
        $todayLate = $todayAttendance->where('status', 'late')->count();

        $recentStudents = Student::with('schoolClass')->latest()->take(5)->get();
        $recentTeachers = Teacher::latest()->take(5)->get();

        $classWiseStudents = SchoolClass::withCount(['students' => function ($query) {
            $query->where('status', 'active');
        }])->where('status', 'active')->get();

        return view('dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalClasses',
            'totalSubjects',
            'todayPresent',
            'todayAbsent',
            'todayLate',
            'recentStudents',
            'recentTeachers',
            'classWiseStudents'
        ));
    }
}
