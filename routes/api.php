<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // User profile
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Instructor routes
    Route::middleware('role:instructor')->prefix('instructor')->group(function () {
        Route::post('/classes', [ClassController::class, 'store']);
        Route::put('/classes/{class}', [ClassController::class, 'update']);
        Route::delete('/classes/{class}', [ClassController::class, 'destroy']);
        Route::get('/bookings', [BookingController::class, 'instructorBookings']);
    });

    // Member routes
    Route::middleware('role:member')->prefix('member')->group(function () {
        Route::post('/bookings', [BookingController::class, 'store']);
        Route::get('/bookings', [BookingController::class, 'memberBookings']);
        Route::delete('/bookings/{booking}', [BookingController::class, 'cancel']);
    });

    // General instructor/member routes
    Route::get('/classes', [ClassController::class, 'index']); // Open for both roles
    Route::get('/classes/{class}', [ClassController::class, 'show']); // Open for both roles
});

