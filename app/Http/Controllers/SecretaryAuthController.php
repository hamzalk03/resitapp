<?php

namespace App\Http\Controllers;

use App\Models\Secretary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SecretaryAuthController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('guest:secretary')->except('logout');
    }
    /**
     * Display a listing of the resource.
     */
    public function Loginindex()
    {
        return view('Secretary.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('secretary')->attempt($credentials, $request->remember)) {
            // Authentication passed...
            $request->session()->regenerate();
            $token = bin2hex(random_bytes(32));
            $request->session()->put('token', $token);

            return redirect()->route('secretary.courses')
                ->with('success', 'Welcome back, ' . Auth::guard('secretary')->user()->name);
        }

        return back()->withErrors([
            'email' => 'Email or password is incorrect.',
        ])->withInput($request->only('email', 'remember'));
    }
    public function logout(Request $request)
    {

        Auth::guard('secretary')->logout(); // Logout using the secretary guard
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/secretary/login');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Secretary $secretary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Secretary $secretary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Secretary $secretary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Secretary $secretary)
    {
        //
    }
}
