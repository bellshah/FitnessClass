<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'class_id',
        'status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function fitnessClass()
    {
        return $this->belongsTo(FitnessClass::class, 'class_id');
    }
} 