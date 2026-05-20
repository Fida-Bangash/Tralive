<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\TeacherSubject;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $query = SchoolClass::withCount(['students' => function ($q) {
            $q->where('status', 'active');
        }]);

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $classes = $query->latest()->paginate(10);
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'nullable|string|max:50',
            'room_number' => 'nullable|string|max:50',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        SchoolClass::create($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Class added successfully!');
    }

    public function show(SchoolClass $class)
    {
        $class->load(['students' => function ($q) {
            $q->orderBy('name');
        }, 'periods.teacher', 'periods.subject']);

        $teacherAssignments = TeacherSubject::with(['teacher', 'subject'])
            ->where('class_id', $class->id)
            ->get();

        $schedule = $class->periods->groupBy('day');
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        return view('classes.show', compact('class', 'teacherAssignments', 'schedule', 'days'));
    }

    public function edit(SchoolClass $class)
    {
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, SchoolClass $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'nullable|string|max:50',
            'room_number' => 'nullable|string|max:50',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $class->update($validated);

        return redirect()->route('classes.index')
            ->with('success', 'Class updated successfully!');
    }

    public function destroy(SchoolClass $class)
    {
        $class->delete();
        return redirect()->route('classes.index')
            ->with('success', 'Class deleted successfully!');
    }
}
