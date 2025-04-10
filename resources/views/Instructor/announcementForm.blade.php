@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Create Announcement for {{ $course->course_code }} - {{ $course->course_name }}</h1>
    <form action="{{ route('instructor.announcement.store', $course) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Announcement</button>
    </form>
</div>
@endsection