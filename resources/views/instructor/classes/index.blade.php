@extends('layouts.instructor')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>My Classes</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassModal">
            + ADD CLASS
        </button>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Capacity</th>
                    <th>Booked</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $class)
                <tr>
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->description }}</td>
                    <td>{{ $class->capacity }}</td>
                    <td>{{ $class->bookings_count }}</td>
                    <td>{{ $class->start_time->format('Y-m-d H:i') }}</td>
                    <td>{{ $class->end_time->format('Y-m-d H:i') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('instructor.classes.edit', $class) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('instructor.classes.destroy', $class) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('instructor.classes.create-modal')
</div>
@endsection 