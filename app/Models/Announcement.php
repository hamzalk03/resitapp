<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'instructor_id',
        'course_id',
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
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
