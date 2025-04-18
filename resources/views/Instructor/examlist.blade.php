@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<h1>Resit Exam List for {{ $course->course_code }} - {{ $course->course_name }}</h1>
<p>Number of students in resit exam: {{ $studentCount }}</p>

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Student Name</th>
            <th>Student ID</th>
            <th>Grade</th> <!-- New column for grade -->
        </tr>
    </thead>
    <tbody>
        @forelse($resitExams as $resitExam)
            <tr>
                <td>{{ $resitExam->student->name }}</td>
                <td>{{ $resitExam->student->id }}</td>
                <td>
                    {{ $resitExam->student->grades->firstWhere('course_id', $course->id)->grade ?? 'N/A' }}
                </td> <!-- Display grade or 'N/A' if not available -->
            </tr>
        @empty
            <tr>
                <td colspan="3">No students found for resit exams.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection