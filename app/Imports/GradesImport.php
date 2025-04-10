<?php

namespace App\Imports;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Course;
use App\Models\Resit_exam;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class GradesImport implements ToModel, WithHeadingRow
{
    protected $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function model(array $row)
    {
        // Define the valid grades
        $validGrades = ['AA', 'BA', 'BB', 'CB', 'CC', 'DC', 'DD', 'DZ', 'FF', 'FD'];

        // Check if the grade is valid
        if (!in_array($row['grade'], $validGrades)) {
            Log::warning('Invalid grade encountered: ' . $row['grade']);
            return null; // Skip this row if the grade is invalid
        }

        // Use student ID directly from the row
        $student = Student::find($row['student_id']);
    
        if ($student && $student->courses->contains($this->course->id)) {
            $grade = Grade::updateOrCreate(
                ['student_id' => $student->id, 'course_id' => $this->course->id],
                ['grade' => $row['grade']]
            );
    
            // If the student is in resit exams but now has a passing grade, remove them
            Resit_exam::where('student_id', $student->id)
                ->where('course_id', $this->course->id)
                ->delete();
    
            return $grade;
        }
    }
}