<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('schoolClass');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('roll_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sortField = $request->get('sort', 'name');
        $sortDir = $request->get('dir', 'asc');
        $query->orderBy($sortField, $sortDir);

        $students = $query->paginate(10);
        $classes = SchoolClass::where('status', 'active')->get();
        return view('students.index', compact('students', 'classes'));
    }

    public function create()
    {
        $classes = SchoolClass::where('status', 'active')->get();
        return view('students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'roll_number' => 'required|string|unique:students,roll_number',
            'class_id' => 'required|exists:classes,id',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'admission_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student added successfully!');
    }

    public function show(Student $student)
    {
        $student->load(['schoolClass', 'attendances' => function ($query) {
            $query->latest('date')->take(30);
        }]);

        $totalDays = $student->attendances->count();
        $presentDays = $student->attendances->where('status', 'present')->count();
        $absentDays = $student->attendances->where('status', 'absent')->count();
        $lateDays = $student->attendances->where('status', 'late')->count();
        $attendancePercentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 1) : 0;

        return view('students.show', compact(
            'student',
            'totalDays',
            'presentDays',
            'absentDays',
            'lateDays',
            'attendancePercentage'
        ));
    }

    public function edit(Student $student)
    {
        $classes = SchoolClass::where('status', 'active')->get();
        return view('students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'roll_number' => 'required|string|unique:students,roll_number,' . $student->id,
            'class_id' => 'required|exists:classes,id',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'admission_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}
