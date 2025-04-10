<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resit_exam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'course_id',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
