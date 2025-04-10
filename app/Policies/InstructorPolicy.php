<?php

namespace App\Policies;

use App\Models\Instructor;
use Illuminate\Auth\Access\Response;

class InstructorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Instructor $instructor): bool
    {
        return true; // Allow viewing any instructor if the user is authenticated
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Instructor $instructor, Instructor $model): bool
    {
        // Allow viewing the instructor if the user is the same instructor
        return $instructor->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Instructor $instructor): bool
    {
        return false; // Allow creating an instructor if the user is authenticated
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Instructor $instructor, Instructor $model): bool
    {
        // Allow updating the instructor if the user is the same instructor
        return $instructor->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Instructor $instructor, Instructor $model): bool
    {
        // Allow deleting the instructor if the user is the same instructor
        return false;
    }
   
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Instructor $instructor, Instructor $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Instructor $instructor, Instructor $model): bool
    {
        return false;
    }
}
