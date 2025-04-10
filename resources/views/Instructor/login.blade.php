@extends('layouts.app')

@section('styles')

@endsection

@section('content')
<div class="container">
    <h2>Login</h2>
    <form method="POST" action="{{ route('instructor.login.submit') }}">
        @csrf
        <div class="form-group">
            <label for="email">email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

</div>
@endsection