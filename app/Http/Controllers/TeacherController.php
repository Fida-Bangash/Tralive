<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherSubject;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('employee_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $teachers = $query->latest()->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $subjects = Subject::where('status', 'active')->get();
        $classes = SchoolClass::where('status', 'active')->get();
        return view('teachers.create', compact('subjects', 'classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'nullable|string|max:20',
            'employee_id' => 'required|string|unique:teachers,employee_id',
            'gender' => 'required|in:male,female,other',
            'qualification' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $teacher = Teacher::create($validated);

        if ($request->has('subject_class')) {
            foreach ($request->subject_class as $assignment) {
                if (!empty($assignment['subject_id']) && !empty($assignment['class_id'])) {
                    TeacherSubject::create([
                        'teacher_id' => $teacher->id,
                        'subject_id' => $assignment['subject_id'],
                        'class_id' => $assignment['class_id'],
                    ]);
                }
            }
        }

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher added successfully!');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load(['subjects', 'classes', 'periods.subject', 'periods.schoolClass']);
        $schedule = $teacher->periods->groupBy('day');
        return view('teachers.show', compact('teacher', 'schedule'));
    }

    public function edit(Teacher $teacher)
    {
        $subjects = Subject::where('status', 'active')->get();
        $classes = SchoolClass::where('status', 'active')->get();
        $teacherSubjects = TeacherSubject::where('teacher_id', $teacher->id)->get();
        return view('teachers.edit', compact('teacher', 'subjects', 'classes', 'teacherSubjects'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone' => 'nullable|string|max:20',
            'employee_id' => 'required|string|unique:teachers,employee_id,' . $teacher->id,
            'gender' => 'required|in:male,female,other',
            'qualification' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $teacher->update($validated);

        TeacherSubject::where('teacher_id', $teacher->id)->delete();
        if ($request->has('subject_class')) {
            foreach ($request->subject_class as $assignment) {
                if (!empty($assignment['subject_id']) && !empty($assignment['class_id'])) {
                    TeacherSubject::create([
                        'teacher_id' => $teacher->id,
                        'subject_id' => $assignment['subject_id'],
                        'class_id' => $assignment['class_id'],
                    ]);
                }
            }
        }

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully!');
    }

    public function schedule(Teacher $teacher)
    {
        $teacher->load(['periods.subject', 'periods.schoolClass']);
        $schedule = $teacher->periods->groupBy('day');
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return view('teachers.schedule', compact('teacher', 'schedule', 'days'));
    }
}
