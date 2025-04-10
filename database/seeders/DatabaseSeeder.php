<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Instructor;
use App\Models\Secretary;
use App\Models\Course;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Comment out the parts that create new records
        // $instructors = Instructor::factory(1)->create();
        // $secretaries = Secretary::factory(1)->create();
        // $courses = Course::factory(5)->make()->each(function ($course) use ($instructors, $secretaries) {
        //     $course->instructor_id = $instructors->random()->id;
        //     $course->secretary_id = $secretaries->random()->id;
        //     $course->save();
        // });
        // $students = Student::factory(5)->create();

        // Fetch existing students and courses
        $students = Student::all();
        $courses = Course::all();

        // Attach courses to students
        $students->each(function ($student) use ($courses) {
            $student->courses()->attach(
                $courses->random(3)->pluck('id')->toArray()
            );
        });

        // Fetch existing course_student relationships
        $courseStudentRelationships = DB::table('course_student')->get();

        // Create grades based on course_student relationships
        $courseStudentRelationships->each(function ($relationship) {
            Grade::factory()->create([
                'student_id' => $relationship->student_id,
                'course_id' => $relationship->course_id,
            ]);
        });
    }
}
