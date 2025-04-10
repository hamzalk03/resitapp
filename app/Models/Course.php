<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_code',
        'course_name',
        'instructor_id',
        'secretary_id',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function secretary()
    {
        return $this->belongsTo(Secretary::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function resitExam()
    {
        return $this->hasMany(Resit_Exam::class);
    }
}
