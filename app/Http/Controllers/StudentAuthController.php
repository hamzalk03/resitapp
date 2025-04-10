<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class StudentAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
    }
    public function loginIndex()
    {
        return view('Student.login');
    }
    public function Login(Request $request)
    {
        $credentials = $request->only('email', 'password'); // Include password in credentials

        if (Auth::attempt($credentials, $request->remember)) {
            // Authentication passed...
            $request->session()->regenerate();
            $token = bin2hex(random_bytes(32));
            $request->session()->put('token', $token);

            return redirect()->route('student.courses')->with('success', ', welcome back!  ' . Auth::user()->name  );
        }

        return back()->withErrors([
            'email' => 'email or password is incorrect.',
        ])->withInput($request->only('email', 'remember'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/student/login');
    }
  
}
