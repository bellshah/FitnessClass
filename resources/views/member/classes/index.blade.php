@extends('layouts.member')

@section('title', 'Available Classes')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Available Classes</h5>
    </div>
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>

<!-- Class Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Book Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="bookingForm" action="{{ route('member.book.class') }}" method="POST">
                    @csrf
                    <input type="hidden" name="fitness_class_id" id="fitnessClassId">
                    <div class="mb-3">
                        <label class="form-label">Class Name</label>
                        <p id="className"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Instructor</label>
                        <p id="instructorName"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <p id="classDescription"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Time</label>
                        <p id="classTime"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Available Slots</label>
                        <p id="availableSlots"></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Book Now</button>
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
        events: '{{ route("member.classes.json") }}',
        eventClick: function(info) {
            var modal = new bootstrap.Modal(document.getElementById('bookingModal'));
            document.getElementById('fitnessClassId').value = info.event.id;
            document.getElementById('className').textContent = info.event.title;
            document.getElementById('instructorName').textContent = info.event.extendedProps.instructor;
            document.getElementById('classDescription').textContent = info.event.extendedProps.description;
            document.getElementById('classTime').textContent = info.event.start.toLocaleString();
            document.getElementById('availableSlots').textContent = info.event.extendedProps.availableSlots;
            modal.show();
        }
    });
    calendar.render();
});
</script>
@endsection 