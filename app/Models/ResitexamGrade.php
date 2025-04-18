<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResitexamGrade extends Model
{
    protected $fillable = ['student_id', 'course_id', 'grade'];

    /**
     * Relationship with the Student model.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Relationship with the Course model.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}