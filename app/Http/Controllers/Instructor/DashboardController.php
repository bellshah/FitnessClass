<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\FitnessClass;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $instructor = Auth::guard('instructor')->user();
        
        $pendingBookings = Booking::whereHas('fitnessClass', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })->where('status', 'pending')->count();

        $totalClasses = FitnessClass::where('instructor_id', $instructor->id)->count();

        $totalMembers = Booking::whereHas('fitnessClass', function($query) use ($instructor) {
            $query->where('instructor_id', $instructor->id);
        })->distinct('member_id')->count();

        return view('instructor.dashboard', compact('pendingBookings', 'totalClasses', 'totalMembers'));
    }
} 