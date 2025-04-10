<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Secretary;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Student $student): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Course $course): bool
    {
        if ($user instanceof Instructor) {
            return $user->courses->contains($course);
        }

        if ($user instanceof Secretary) {
            // Logic to determine if a secretary can view the course
            return true; // Assuming secretaries can view all courses
        }

        return false;
    }
    public function viewAnnouncements(Student $student, Course $course): bool
{
    return $student->courses->contains($course);
}
public function requestResitExam(Student $student, Course $course): bool
{
    return $student->courses->contains($course);
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
    public function update($user, Course $course): bool
    {
        if ($user instanceof Instructor) {
            return $user->courses->contains($course);
        }

        if ($user instanceof Secretary) {
            // Logic to determine if a secretary can update the course
            return true; // Assuming secretaries can update all courses
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Student $student, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Student $student, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Student $student, Course $course): bool
    {
        return false;
    }
}
