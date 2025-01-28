@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="fitness-bg">
    <div class="pattern-overlay"></div>
    <div class="container-fluid welcome-container">
        
        <!-- Login/Register Cards -->
        <div class="row justify-content-center">
            <!-- Member Section -->
            <div class="col-md-5 section-card animate-fadeUp" style="animation-delay: 0.2s">
                <div class="card">
                    <div class="card-body text-center p-5">
                        <div class="icon-circle mb-4">
                            <i class="fas fa-user-circle fa-3x text-primary"></i>
                        </div>
                        <h2 class="card-title">Members</h2>
                        <p class="card-text mb-4">
                            Start your fitness journey today! Access premium classes, track your progress,
                            and achieve your health goals with our expert guidance.
                        </p>
                        <div class="button-group">
                            <a href="{{ route('member.login') }}" class="btn btn-primary btn-lg mb-3 w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </a>
                            <a href="{{ route('member.register') }}" class="btn btn-outline-primary btn-lg w-100">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructor Section -->
            <div class="col-md-5 section-card animate-fadeUp" style="animation-delay: 0.4s">
                <div class="card">
                    <div class="card-body text-center p-5">
                        <div class="icon-circle mb-4">
                            <i class="fas fa-chalkboard-teacher fa-3x text-primary"></i>
                        </div>
                        <h2 class="card-title">Instructors</h2>
                        <p class="card-text mb-4">
                            Share your expertise and inspire others! Manage your classes,
                            create dynamic workouts, and build your fitness community.
                        </p>
                        <div class="button-group">
                            <a href="{{ route('instructor.auth.login') }}" class="btn btn-primary btn-lg mb-3 w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </a>
                            <a href="{{ route('instructor.auth.register') }}" class="btn btn-outline-primary btn-lg w-100">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
