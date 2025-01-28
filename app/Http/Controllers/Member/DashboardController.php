<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $member = Auth::guard('member')->user();
        
        $pendingBookings = Booking::where('member_id', $member->id)
            ->where('status', 'pending')
            ->count();

        return view('member.dashboard', compact('pendingBookings'));
    }
} 