@extends('layouts.instructor')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Pending Bookings</h5>
                <h2 class="text-primary">{{ $pendingBookings }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Total Classes</h5>
                <h2 class="text-success">{{ $totalClasses }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Total Members</h5>
                <h2 class="text-info">{{ $totalMembers }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Class Schedule</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassModal">
            <i class="fas fa-plus"></i> Add Class
        </button>
    </div>
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>

<!-- Add Class Modal -->
<div class="modal fade" id="addClassModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('instructor.classes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Class Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Capacity</label>
                        <input type="number" class="form-control" name="capacity" required min="1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Start Time</label>
                        <input type="datetime-local" class="form-control" name="start_time" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">End Time</label>
                        <input type="datetime-local" class="form-control" name="end_time" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Class</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '{{ route("instructor.classes.json") }}',
        eventClick: function(info) {
            window.location.href = '/instructor/classes/' + info.event.id;
        }
    });
    calendar.render();
});
</script>
@endsection 