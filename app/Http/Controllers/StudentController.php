<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\Resit_exam;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StudentController extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('StudentAuth');
        $this->authorizeResource(Student::class, 'student');
    }
 
    public function index()
    {
        $student = Auth::user(); // Get the authenticated student
        $this->authorize('view', $student); // Pass the actual student instance
        
        // Get the student's courses
        $courses = $student->courses;
        $grades = $student->grades;
        
        // Get all resit exams for the student
        $resitExams = Resit_Exam::whereIn('course_id', $student->courses->pluck('id'))
                               ->where('student_id', $student->id)
                               ->get(); // Get resit exams for the student's courses
    
        // Get announcements for the courses with resit exams
        $announcements = Announcement::whereIn('course_id', $resitExams->pluck('course_id'))
                                      ->with('course') // Eager load the related course
                                      ->latest()
                                      ->get();
    
        return view('student.index', compact('courses', 'grades', 'announcements', 'resitExams'));
    } 
    

    
    public function requestResitExam(Request $request, Course $course)
    {
        $student = Auth::user();
        $this->authorize('requestResitExam', $course);
    
        // Check if the student is enrolled in the course
        if (!$student->courses->contains($course->id)) {
            return redirect()->route('student.courses')->with('error', 'You are not enrolled in this course.');
        }
    
        // Get the student's grade for the course
        $grade = Grade::where('student_id', $student->id)
                      ->where('course_id', $course->id)
                      ->value('grade');
    
        // Allow resit exam request only if the grade is FF, FD, DC, or DD
        if (in_array($grade, ['FF', 'FD', 'DC', 'DD'])) {
            Resit_exam::updateOrCreate(
                ['student_id' => $student->id, 'course_id' => $course->id]
            );
    
            return redirect()->route('student.courses')->with('success', 'Resit exam requested successfully.');
        }
    
        return redirect()->route('student.courses')->with('error', 'You are not eligible to request a resit exam.');
    }
    

    public function showCourseAnnouncements(Course $course)
{
    $student = Auth::user();
    $this->authorize('viewAnnouncements', $course);

    // Check if the student is enrolled in the course and has a resit exam
    if (!$student->courses->contains($course->id) || !$course->resitExam->contains('student_id', $student->id)) {
        return redirect()->route('student.courses')->with('error', 'You are not eligible to view announcements for this course.');
    }

    $announcements = Announcement::where('course_id', $course->id)->get();

    return view('student.announcements', compact('course', 'announcements'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $this->authorize('view', $student);
        // Add your logic here
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        //
    }
}
