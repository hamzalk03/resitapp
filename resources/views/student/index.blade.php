@extends('layouts.app')

@section('content')
<h1>Hello, {{ Auth::user()->name }} ({{ Auth::user()->id }})</h1>
<h2>Your Courses:</h2>
<ul>
    @foreach($courses as $course)
        <li>
            {{ $course->course_code }} - {{ $course->course_name }}
            <p><strong>Dr.</strong> {{ $course->instructor->name ?? 'Not Assigned' }}</p>
            <ul>
                @foreach($grades as $grade)
                    @if($grade->course_id == $course->id)
                        
                           <p><strong>Grade:</strong> {{ $grade->grade }}</p> 
                            @if($resitExam = $resitExams->firstWhere('course_id', $course->id))
                                @if($resitExam->resitexamDetails->isEmpty())
                                    <p><strong>Resit Exam:</strong> Not Scheduled</p>
                                @else
                                    @foreach($resitExam->resitexamDetails as $detail)
                                        <p><strong>Resit Exam Date:</strong> {{ $detail->exam_date ?? 'Not Scheduled' }}   {{ $detail->exam_time ?? 'Not Scheduled' }}</p>
                                        <p><strong>Resit Exam Hall:</strong> {{ $detail->exam_hall ?? 'Not Scheduled' }}</p>
                                    @endforeach
                                @endif
                                <a class="btn btn-info btn-sm" href="{{ route('student.course.announcements', ['course' => $course->id]) }}">
                                    View Announcements
                                </a>
                                @if($newGrade = $newGrades->firstWhere('course_id', $course->id))
                                    <p class="mt-3"><strong>New Grade:</strong> {{ $newGrade->grade }}</p>
                                @endif
                            @elseif(in_array($grade->grade, ['DD', 'DC', 'FF', 'FD']) && !$resitExams->contains('course_id', $course->id))
                                <form action="{{ route('student.resit.request', ['course' => $course->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">I want to take Resit Exam</button>
                                </form>
                            @endif
                        
                    @endif
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
@endsection