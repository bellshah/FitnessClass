<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::whereHas('fitnessClass', function($query) {
            $query->where('instructor_id', Auth::guard('instructor')->id());
        })->with(['member', 'fitnessClass'])
          ->orderBy('created_at', 'desc')
          ->get();

        return view('instructor.bookings', compact('bookings'));
    }

    public function approve(Booking $booking)
    {
        $this->authorize('update', $booking->fitnessClass);

        if ($booking->fitnessClass->availableSlots() > 0) {
            $booking->update(['status' => 'approved']);
            return back()->with('success', 'Booking approved successfully.');
        }

        return back()->with('error', 'No available slots for this class.');
    }

    public function reject(Booking $booking)
    {
        $this->authorize('update', $booking->fitnessClass);
        
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Booking rejected successfully.');
    }
} 