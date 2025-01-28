<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\FitnessClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('member_id', Auth::guard('member')->id())
            ->with(['fitnessClass.instructor'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.bookings', compact('bookings'));
    }

    public function bookClass(Request $request)
    {
        $request->validate([
            'fitness_class_id' => 'required|exists:fitness_classes,id'
        ]);

        $fitnessClass = FitnessClass::findOrFail($request->fitness_class_id);

        // Check if member already booked this class
        $existingBooking = Booking::where('member_id', Auth::guard('member')->id())
            ->where('fitness_class_id', $fitnessClass->id)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existingBooking) {
            return back()->with('error', 'You have already booked this class.');
        }

        // Check if class has available slots
        if ($fitnessClass->availableSlots() <= 0) {
            return back()->with('error', 'This class is fully booked.');
        }

        Booking::create([
            'member_id' => Auth::guard('member')->id(),
            'fitness_class_id' => $fitnessClass->id,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Class booked successfully. Waiting for instructor approval.');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->member_id !== Auth::guard('member')->id()) {
            abort(403);
        }

        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function getClassesJson()
    {
        $classes = FitnessClass::with(['instructor', 'bookings'])
            ->where('start_time', '>', now())
            ->get()
            ->map(function($class) {
                return [
                    'id' => $class->id,
                    'title' => $class->name,
                    'start' => $class->start_time->toIso8601String(),
                    'end' => $class->end_time->toIso8601String(),
                    'extendedProps' => [
                        'instructor' => $class->instructor->name,
                        'description' => $class->description,
                        'availableSlots' => $class->availableSlots(),
                    ]
                ];
            });

        return response()->json($classes);
    }
} 