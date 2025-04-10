<?php

namespace App\Http\Controllers;

use App\Models\Secretary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Announcement;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class SecretaryController extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth:secretary'); // Use the Secretary guard
        $this->middleware('SecretaryAuth');
        $this->authorizeResource(Secretary::class, 'secretary');
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $secretary = Auth::guard('secretary')->user(); // Use the Secretary guard
      

        $courses = $secretary->courses; // Assuming the Secretary model has a courses relationship

        return view('Secretary.index', compact('courses'));
    }
    public function showAnnouncementForm(Course $course)
    {
        $this->authorize('update', $course);

        return view('secretary.announcementForm', compact('course'));
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

        return redirect()->route('secretary.courses')->with('success', 'Announcement created successfully.');
    }

    public function showCourseAnnouncements(Course $course)
    {
        $this->authorize('view', $course);

        $announcements = Announcement::where('course_id', $course->id)->get();

        return view('secretary.announcements', compact('course', 'announcements'));
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
    public function show(Secretary $secretary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Secretary $secretary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Secretary $secretary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Secretary $secretary)
    {
        //
    }
}
