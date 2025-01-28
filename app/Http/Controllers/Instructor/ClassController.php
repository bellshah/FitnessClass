<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\FitnessClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index()
    {
        $classes = FitnessClass::where('instructor_id', Auth::guard('instructor')->id())
            ->withCount('bookings')
            ->orderBy('start_time')
            ->get();

        return view('instructor.classes.index', ['classes' => $classes]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $validated['instructor_id'] = Auth::guard('instructor')->id();

        FitnessClass::create($validated);

        return redirect()->route('instructor.classes')
            ->with('success', 'Class created successfully!');
    }

    public function edit(FitnessClass $class)
    {
        return view('instructor.classes.edit', compact('class'));
    }

    public function update(Request $request, FitnessClass $class)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $class->update($validated);

        return redirect()->route('instructor.classes')
            ->with('success', 'Class updated successfully!');
    }

    public function destroy(FitnessClass $class)
    {
        $class->delete();
        return redirect()->route('instructor.classes')
            ->with('success', 'Class deleted successfully!');
    }

    public function getClassesJson()
    {
        $classes = FitnessClass::where('instructor_id', Auth::guard('instructor')->id())
            ->withCount('bookings')
            ->orderBy('start_time')
            ->get()
            ->map(function ($class) {
                return [
                    'id' => $class->id,
                    'title' => $class->name,
                    'start' => $class->start_time,
                    'end' => $class->end_time,
                    'bookings_count' => $class->bookings_count,
                    'capacity' => $class->capacity
                ];
            });

        return response()->json($classes);
    }

    // Add other methods (edit, update, destroy) as needed
} 