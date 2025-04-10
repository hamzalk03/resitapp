<?php

namespace App\Http\Controllers;

use App\Models\instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Resit_exam;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Grade;
use App\Models\Course;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GradesImport;
use Illuminate\Support\Facades\Log;
use App\Models\Announcement;

class InstructorController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth:instructor'); // Use the instructor guard
        $this->middleware('InstructorAuth');
        $this->authorizeResource(Instructor::class, 'instructor');
    }

    public function index()
    {
        $instructor = Auth::guard('instructor')->user(); // Use the instructor guard
      

        $courses = $instructor->courses; // Assuming the Instructor model has a courses relationship

        return view('instructor.index', compact('courses'));
    }

    public function uploadGrades(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $request->validate([
            'grades_file' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new GradesImport($course), $request->file('grades_file'));
            return redirect()->route('instructor.courses')->with('success', 'Grades uploaded successfully.');
        } catch (\Exception $e) {
            Log::error('Error uploading grades: ' . $e->getMessage());
            return redirect()->route('instructor.courses')->with('error', 'There was an error uploading the grades. Please try again.');
        }
    }

    public function resitExamList(Course $course)
    {
        $this->authorize('view', $course);
    
        $resitExams = Resit_exam::where('course_id', $course->id)->with('student')->get();
        $studentCount = $resitExams->count(); // Count the number of students in the resit exam
    
        return view('instructor.examlist', compact('course', 'resitExams', 'studentCount'));
    }

    public function showAnnouncementForm(Course $course)
    {
        $this->authorize('update', $course);

        return view('instructor.announcementForm', compact('course'));
    }

    public function storeAnnouncement(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $announcementData = [
            'title' => $request->title,
            'content' => $request->content,
            'course_id' => $course->id,
        ];

        if (Auth::guard('instructor')->check()) {
            $announcementData['instructor_id'] = Auth::guard('instructor')->id();
        } elseif (Auth::guard('secretary')->check()) {
            $announcementData['secretary_id'] = Auth::guard('secretary')->id();
        }

        Announcement::create($announcementData);

        return redirect()->route('instructor.courses')->with('success', 'Announcement created successfully.');
    }

    public function showCourseAnnouncements(Course $course)
    {
        $this->authorize('view', $course);

        $announcements = Announcement::where('course_id', $course->id)->get();

        return view('instructor.announcements', compact('course', 'announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Instructor::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Instructor::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(instructor $instructor)
    {
        $this->authorize('view', $instructor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(instructor $instructor)
    {
        $this->authorize('update', $instructor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, instructor $instructor)
    {
        $this->authorize('update', $instructor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(instructor $instructor)
    {
        $this->authorize('delete', $instructor);
    }
}