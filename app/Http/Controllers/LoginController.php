<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a login form.
     *
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     *
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // intended() tries to redirect to the URL the user was trying to access before being redirected to the login page
            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log out the user from application.
     *
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
