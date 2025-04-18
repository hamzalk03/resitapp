@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
       
        <form action="{{ route('secretary.upload.exam.dates') }}" method="POST" enctype="multipart/form-data"
            class="mt-3">
            @csrf
            <div class="mb-3">
               <h1><label for="exam_dates_file" class="form-label">Upload Exam Details (Excel)</label></h1> 
                <input type="file" name="exam_dates_file" id="exam_dates_file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Upload</button>
        </form>
        <div class="card shadow-sm p-4">
            <h1 class="text-primary fw-bold">Hello, {{ Auth::guard('secretary')->user()->name }}</h1>
            <h2 class="mt-3">Your Courses:</h2>

            <ul class="list-group mt-3">
                @forelse($courses as $course)
                    <li class="list-group-item">
                        <h5 class="fw-semibold">({{ $course->id }})  {{ $course->course_code }} - {{ $course->course_name }}</h5>

                        <a class="btn btn-secondary btn-sm mt-2"
                            href="{{ route('secretary.announcement.form', ['course' => $course->id]) }}">
                            Create Announcement
                        </a>
                        <a class="btn btn-info btn-sm mt-2"
                            href="{{ route('secretary.course.announcements', ['course' => $course->id]) }}">
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