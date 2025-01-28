<?php

namespace App\Policies;

use App\Models\FitnessClass;
use App\Models\Instructor;
use Illuminate\Auth\Access\HandlesAuthorization;

class FitnessClassPolicy
{
    use HandlesAuthorization;

    public function view(Instructor $instructor, FitnessClass $class)
    {
        return $instructor->id === $class->instructor_id;
    }

    public function update(Instructor $instructor, FitnessClass $class)
    {
        return $instructor->id === $class->instructor_id;
    }

    public function delete(Instructor $instructor, FitnessClass $class)
    {
        return $instructor->id === $class->instructor_id;
    }
} 