<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FitnessClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'capacity',
        'start_time',
        'end_time',
        'instructor_id'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'class_id');
    }

    public function availableSlots()
    {
        $bookedCount = $this->bookings()->whereIn('status', ['pending', 'approved'])->count();

        return max(0, $this->capacity - $bookedCount);
    }
} 