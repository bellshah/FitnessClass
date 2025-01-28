@extends('layouts.app')

@section('title', 'Instructor Login')

@section('content')
<div class="fitness-bg min-vh-100">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-chalkboard-teacher fa-3x text-primary"></i>
                            <h2 class="mt-3">Instructor Login</h2>
                        </div>

                        <form method="POST" action="{{ route('instructor.auth.login.submit') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-4">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>

                            <div class="text-center">
                                <p>Don't have an account? <a href="{{ route('instructor.auth.register') }}" class="text-primary">Register here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 