@extends('layouts.instructor')

@section('title', 'Manage Bookings')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Manage Bookings</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Class</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->member->name }}</td>
                        <td>{{ $booking->fitnessClass->name }}</td>
                        <td>{{ $booking->fitnessClass->start_time->format('M d, Y h:i A') }}</td>
                        <td>
                            <span class="badge bg-{{ $booking->status === 'pending' ? 'warning' : ($booking->status === 'approved' ? 'success' : 'danger') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>
                            @if($booking->status === 'pending')
                            <form action="{{ route('instructor.bookings.approve', $booking) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    Approve
                                </button>
                            </form>
                            <form action="{{ route('instructor.bookings.reject', $booking) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Reject
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