<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with(['student', 'schoolClass', 'subject', 'teacher']);

        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $attendances = $query->latest('date')->paginate(20);
        $classes = SchoolClass::where('status', 'active')->get();

        return view('attendance.index', compact('attendances', 'classes'));
    }

    public function create()
    {
        $classes = SchoolClass::where('status', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        $teachers = Teacher::where('status', 'active')->get();
        return view('attendance.create', compact('classes', 'subjects', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'nullable|exists:subjects,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required|exists:students,id',
            'attendance.*.status' => 'required|in:present,absent,late,excused',
        ]);

        foreach ($request->attendance as $record) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $record['student_id'],
                    'class_id' => $request->class_id,
                    'date' => $request->date,
                    'subject_id' => $request->subject_id,
                ],
                [
                    'teacher_id' => $request->teacher_id,
                    'status' => $record['status'],
                    'remarks' => $record['remarks'] ?? null,
                ]
            );
        }

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance marked successfully!');
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['student', 'schoolClass', 'subject', 'teacher']);
        return view('attendance.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        return view('attendance.edit', compact('attendance'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'status' => 'required|in:present,absent,late,excused',
            'remarks' => 'nullable|string',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance updated successfully!');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendance.index')
            ->with('success', 'Attendance record deleted!');
    }

    public function markAttendance(Request $request)
    {
        $classId = $request->get('class_id');
        $date = $request->get('date', today()->format('Y-m-d'));

        $classes = SchoolClass::where('status', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        $teachers = Teacher::where('status', 'active')->get();
        $students = collect();
        $existingAttendance = collect();

        if ($classId) {
            $students = Student::where('class_id', $classId)
                ->where('status', 'active')
                ->orderBy('roll_number')
                ->get();

            $existingAttendance = Attendance::where('class_id', $classId)
                ->where('date', $date)
                ->get()
                ->keyBy('student_id');
        }

        return view('attendance.mark', compact(
            'classes',
            'subjects',
            'teachers',
            'students',
            'existingAttendance',
            'classId',
            'date'
        ));
    }

    public function report(Request $request)
    {
        $classes = SchoolClass::where('status', 'active')->get();
        $classId = $request->get('class_id');
        $month = $request->get('month', now()->format('Y-m'));
        $reportData = collect();

        if ($classId) {
            $students = Student::where('class_id', $classId)
                ->where('status', 'active')
                ->orderBy('name')
                ->get();

            $startDate = \Carbon\Carbon::parse($month . '-01');
            $endDate = $startDate->copy()->endOfMonth();

            foreach ($students as $student) {
                $attendance = Attendance::where('student_id', $student->id)
                    ->whereBetween('date', [$startDate, $endDate])
                    ->get();

                $reportData->push([
                    'student' => $student,
                    'present' => $attendance->where('status', 'present')->count(),
                    'absent' => $attendance->where('status', 'absent')->count(),
                    'late' => $attendance->where('status', 'late')->count(),
                    'excused' => $attendance->where('status', 'excused')->count(),
                    'total' => $attendance->count(),
                ]);
            }
        }

        return view('attendance.report', compact('classes', 'reportData', 'classId', 'month'));
    }

    public function getStudentsByClass(Request $request)
    {
        $students = Student::where('class_id', $request->class_id)
            ->where('status', 'active')
            ->orderBy('roll_number')
            ->get(['id', 'name', 'roll_number']);

        return response()->json($students);
    }
}
