@extends('layouts.member')

@section('title', 'My Bookings')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">My Bookings</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Instructor</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->fitnessClass->name }}</td>
                        <td>{{ $booking->fitnessClass->instructor->name }}</td>
                        <td>{{ $booking->fitnessClass->start_time->format('M d, Y h:i A') }}</td>
                        <td>
                            <span class="badge bg-{{ $booking->status === 'pending' ? 'warning' : ($booking->status === 'approved' ? 'success' : 'danger') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>
                            @if($booking->status === 'pending' || $booking->status === 'approved')
                            <form action="{{ route('member.cancel.booking', $booking) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                    Cancel
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 