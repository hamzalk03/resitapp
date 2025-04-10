<?php

namespace App\Policies;

use App\Models\Student;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Student $student): bool
    {
        // Allow viewing any student if the user is authenticated
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Student $student, Student $model): bool
    {
        // Allow viewing the student if the user is the same student
        return $student->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Student $student): bool
    {
        // Allow creating a student if the user is authenticated
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Student $student, Student $model): bool
    {
        // Allow updating the student if the user is the same student
        return $student->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Student $student, Student $model): bool
    {
        // Allow deleting the student if the user is the same student
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Student $student, Student $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Student $student, Student $model): bool
    {
        return false;
    }
}
