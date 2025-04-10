@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-sm p-4">
        <h1 class="text-primary fw-bold">Hello, {{ Auth::guard('secretary')->user()->name }}</h1>
        <h2 class="mt-3">Your Courses:</h2>
        
        <ul class="list-group mt-3">
            @forelse($courses as $course)
                <li class="list-group-item">
                    <h5 class="fw-semibold">{{ $course->course_code }} - {{ $course->course_name }}</h5>
                    
                    <a class="btn btn-secondary btn-sm mt-2" href="{{ route('secretary.announcement.form', ['course' => $course->id]) }}">
                        Create Announcement
                    </a>
                    <a class="btn btn-info btn-sm mt-2" href="{{ route('secretary.course.announcements', ['course' => $course->id]) }}">
                        View Announcements
                    </a>

                </li>
            @empty
                <li class="list-group-item text-danger">No courses found.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection