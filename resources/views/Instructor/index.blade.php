@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-sm p-4">
        <h1 class="text-primary fw-bold">Hello, {{ Auth::guard('instructor')->user()->name }}</h1>
        <h2 class="mt-3">Your Courses:</h2>
        
        <ul class="list-group mt-3">
            @forelse($courses as $course)
                <li class="list-group-item">
                    <h5 class="fw-semibold">{{ $course->course_code }} - {{ $course->course_name }}</h5>
                    
                    <a class="btn btn-dark btn-sm mt-2" href="{{ route('instructor.resit.exams', ['course' => $course->id]) }}">
                        Resit Exams
                    </a>
                    
                    <a class="btn btn-secondary btn-sm mt-2" href="{{ route('instructor.announcement.form', ['course' => $course->id]) }}">
                        Create Announcement
                    </a>
                    <a class="btn btn-info btn-sm mt-2" href="{{ route('instructor.course.announcements', ['course' => $course->id]) }}">
                        View Announcements
                    </a>

                    <div class="mt-3">
                        <h4 class="fw-semibold">Upload Grades</h4>
                        <form action="{{ route('instructor.grades.upload', $course) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="grades_file" class="form-label">Grades File (Excel)</label>
                                <input type="file" name="grades_file" id="grades_file" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="list-group-item text-danger">No courses found.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection