<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\FitnessClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function memberBookings()
    {
        $bookings = Booking::where('member_id', Auth::id())
            ->with(['fitnessClass.instructor'])
            ->get();
        return response()->json($bookings);
    }

    public function instructorBookings()
    {
        $bookings = Booking::whereHas('fitnessClass', function($query) {
            $query->where('instructor_id', Auth::id());
        })->with(['member', 'fitnessClass'])->get();
        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fitness_class_id' => 'required|exists:fitness_classes,id'
        ]);

        $booking = Booking::create([
            'member_id' => Auth::id(),
            'fitness_class_id' => $validated['fitness_class_id'],
            'status' => 'pending'
        ]);

        return response()->json($booking, 201);
    }

    public function cancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return response()->json(['message' => 'Booking cancelled']);
    }
} 