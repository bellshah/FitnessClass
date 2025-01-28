<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MemberAuthController;
use App\Http\Controllers\Auth\InstructorAuthController;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Instructor\ClassController;
use App\Http\Controllers\Instructor\BookingController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\BookingController as MemberBookingController;

Route::get('/', function () {
    return view('welcome');
});

// Member Routes
Route::group(['prefix' => 'member', 'as' => 'member.'], function () {
    // Auth Routes
    Route::middleware('guest:member')->group(function () {
        Route::get('/register', [MemberAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [MemberAuthController::class, 'register'])->name('register.submit');
        Route::get('/login', [MemberAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [MemberAuthController::class, 'login'])->name('login.submit');
    });
    Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');

    // Protected Routes
    Route::middleware('auth:member')->group(function () {
        Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
        Route::get('/bookings', [MemberBookingController::class, 'index'])->name('bookings');
        Route::post('/book-class', [MemberBookingController::class, 'bookClass'])->name('book.class');
        Route::delete('/bookings/{booking}/cancel', [MemberBookingController::class, 'cancel'])->name('cancel.booking');
        Route::get('/classes-json', [MemberBookingController::class, 'getClassesJson'])->name('classes.json');
    });
});

// Instructor Routes
Route::group(['prefix' => 'instructor', 'as' => 'instructor.'], function () {
    // Guest routes
    Route::middleware('guest:instructor')->group(function () {
        Route::get('/register', [InstructorAuthController::class, 'showRegisterForm'])->name('auth.register');
        Route::post('/register', [InstructorAuthController::class, 'register'])->name('auth.register.submit');
        Route::get('/login', [InstructorAuthController::class, 'showLoginForm'])->name('auth.login');
        Route::post('/login', [InstructorAuthController::class, 'login'])->name('auth.login.submit');
    });
    Route::post('/logout', [InstructorAuthController::class, 'logout'])->name('logout');

    // Protected routes
    Route::middleware('auth:instructor')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Add the classes routes here
        Route::get('/classes', [ClassController::class, 'index'])->name('classes');
        Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
        Route::get('/classes/{class}/edit', [ClassController::class, 'edit'])->name('classes.edit');
        Route::put('/classes/{class}', [ClassController::class, 'update'])->name('classes.update');
        Route::delete('/classes/{class}', [ClassController::class, 'destroy'])->name('classes.destroy');
        // Add the JSON endpoint
        Route::get('/classes-json', [ClassController::class, 'getClassesJson'])->name('classes.json');
        // Add bookings route
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
