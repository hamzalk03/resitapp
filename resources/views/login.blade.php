@extends('layouts.app')

@section('styles')
<style>
    .login-container {
      margin-top: 120px;
    }
    .login-card {
        max-width: 400px;
        border-radius: 10px;
    }
</style>
@endsection

@section('content')
<div class="container d-flex justify-content-center align-items-center login-container ">
    <div class="card shadow-lg p-4 login-card">
        <div class="card-body text-center">
            <h3 class="mb-4 fw-bold text-primary">Welcome</h3>
            <p class="text-muted mb-4">Select your login type</p>
            <a href="{{ route('student.login') }}" class="btn btn-primary btn-lg w-100 mb-3">Student Login</a>
            <a href="{{ route('instructor.login') }}" class="btn btn-outline-secondary btn-lg w-100 mb-3">Instructor Login</a>
            <a href="{{ route('secretary.login') }}" class="btn btn-dark btn-lg w-100">Secretary Login</a>
        </div>
    </div>
</div>
@endsection
