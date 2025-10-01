<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $credentials = $request->validate([

            'email' => 'required|email',

            'password' => 'required',

        ]);



        // Attempt to log in

        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // Regenerate session for security

            $request->session()->regenerate();



            // Redirect to intended page or home

            return redirect()->intended('/')->with('success', 'Welcome back!');
        }



        // If login fails, redirect back with error

        return back()

            ->withErrors(['email' => 'The provided credentials do not match our records.'])

            ->onlyInput('email');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        Auth::logout();

        $request->session()->invalidate(); // Invalidate the session

        $request->session()->regenerateToken(); // Regenerate the CSRF token


        return redirect('/')->with('success', 'logged out successfully');
    }
}
