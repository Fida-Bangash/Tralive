<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index(Request $request)
    {
        $query = Period::with(['teacher', 'subject', 'schoolClass']);

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        if ($request->filled('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->filled('day')) {
            $query->where('day', $request->day);
        }

        $periods = $query->orderBy('day')->orderBy('period_number')->paginate(15);
        $classes = SchoolClass::where('status', 'active')->get();
        $teachers = Teacher::where('status', 'active')->get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        return view('periods.index', compact('periods', 'classes', 'teachers', 'days'));
    }

    public function create()
    {
        $teachers = Teacher::where('status', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        $classes = SchoolClass::where('status', 'active')->get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return view('periods.create', compact('teachers', 'subjects', 'classes', 'days'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'period_number' => 'required|integer|min:1|max:10',
        ]);

        Period::create($validated);

        return redirect()->route('periods.index')
            ->with('success', 'Period added successfully!');
    }

    public function show(Period $period)
    {
        $period->load(['teacher', 'subject', 'schoolClass']);
        return view('periods.show', compact('period'));
    }

    public function edit(Period $period)
    {
        $teachers = Teacher::where('status', 'active')->get();
        $subjects = Subject::where('status', 'active')->get();
        $classes = SchoolClass::where('status', 'active')->get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return view('periods.edit', compact('period', 'teachers', 'subjects', 'classes', 'days'));
    }

    public function update(Request $request, Period $period)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'period_number' => 'required|integer|min:1|max:10',
        ]);

        $period->update($validated);

        return redirect()->route('periods.index')
            ->with('success', 'Period updated successfully!');
    }

    public function destroy(Period $period)
    {
        $period->delete();
        return redirect()->route('periods.index')
            ->with('success', 'Period deleted successfully!');
    }
}
