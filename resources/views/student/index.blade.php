@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<h1>Hello, {{ Auth::user()->name }} ({{ Auth::user()->id }})</h1>
<h2>Your Courses:</h2>
<ul>
    @foreach($courses as $course)
        <li>
            {{ $course->course_code }} - {{ $course->course_name }}
            <ul>
                @foreach($grades as $grade)
                    @if($grade->course_id == $course->id)
                        <li>
                            Grade: {{ $grade->grade }}
                            @if( $course->resitExam->contains('student_id', Auth::user()->id))
                                <span>You will take resit exam</span>
                                <a class="btn btn-info btn-sm mt-2" href="{{ route('student.course.announcements', ['course' => $course->id]) }}">
                                    View Announcements
                                </a>
                            @elseif(in_array($grade->grade, ['DD', 'DC' , 'FF' , 'FD']) && !$course->resitExam->contains('student_id', Auth::user()->id))
                                <form action="{{ route('student.resit.request', ['course' => $course->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">I want to take Resit Exam</button>
                                </form>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
@endsection