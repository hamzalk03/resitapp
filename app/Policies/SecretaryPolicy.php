<?php

namespace App\Policies;

use App\Models\Secretary;
use App\Models\Student;
use Illuminate\Auth\Access\Response;

class SecretaryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Secretary $secretary): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Secretary $secretary, Secretary $model): bool
    {
        // Allow viewing the secretary if the user is the same instructor
        return $secretary->id === $model->id;
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(Student $student): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update( Secretary $secretary , Secretary $model): bool
    {
        return $secretary->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Student $student, Secretary $secretary): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Student $student, Secretary $secretary): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Student $student, Secretary $secretary): bool
    {
        return false;
    }
}
