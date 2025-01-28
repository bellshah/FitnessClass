<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FitnessClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function index()
    {
        $classes = FitnessClass::with('instructor')->get();
        return response()->json($classes);
    }

    public function show(FitnessClass $class)
    {
        return response()->json($class->load('instructor'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time'
        ]);

        $class = FitnessClass::create([
            ...$validated,
            'instructor_id' => Auth::id()
        ]);

        return response()->json($class, 201);
    }

    public function update(Request $request, FitnessClass $class)
    {
        $class->update($request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time'
        ]));

        return response()->json($class);
    }

    public function destroy(FitnessClass $class)
    {
        $class->delete();
        return response()->json(null, 204);
    }
} 