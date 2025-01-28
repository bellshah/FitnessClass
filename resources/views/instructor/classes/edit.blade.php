@extends('layouts.instructor')

@section('content')
<div class="container">
    <h1>Edit Class</h1>
    <form action="{{ route('instructor.classes.update', $class) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Class Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $class->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $class->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $class->capacity }}" min="1" required>
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ $class->start_time->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ $class->end_time->format('Y-m-d\TH:i') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Class</button>
        <a href="{{ route('instructor.classes') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection 