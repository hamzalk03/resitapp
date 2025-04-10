<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class InstructorAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:instructor')->except('logout');
    }
    
    public function loginIndex()
    {
        return view('Instructor.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('instructor')->attempt($credentials, $request->remember)) {
            // Authentication passed...
            $request->session()->regenerate();
            $token = bin2hex(random_bytes(32));
            $request->session()->put('token', $token);

            return redirect()->route('instructor.courses')
                ->with('success', 'Welcome back, ' . Auth::guard('instructor')->user()->name);
        }

        return back()->withErrors([
            'email' => 'Email or password is incorrect.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {

        Auth::guard('instructor')->logout(); // Logout using the instructor guard
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/instructor/login');
    }
}
