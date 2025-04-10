@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Announcements for {{ $course->course_code }} - {{ $course->course_name }}</h1>
    <ul class="list-group mt-3">
        @forelse($announcements as $announcement)
            <li class="list-group-item">
                <h5 class="fw-semibold">{{ $announcement->title }}</h5>
                <p>{{ $announcement->content }}</p>
                <small>
                    Posted by: 
                    @if($announcement->instructor)
                        Dr. {{ $announcement->instructor->name }}
                    @elseif($announcement->secretary)
                        Sec. {{ $announcement->secretary->name }}
                    @endif
                </small>
                <br>
                <small>{{ $announcement->created_at }}</small>
            </li>
        @empty
            <li class="list-group-item text-danger">No announcements found.</li>
        @endforelse
    </ul>
</div>
@endsection