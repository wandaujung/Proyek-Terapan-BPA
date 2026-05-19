<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =====================
    // FORM
    // =====================
    public function loginForm()
    {
        return view('auth.login');
    }


    public function registerForm()
{
    return view('auth.register');
}
public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/login')->with('success', 'Register berhasil');
}

    // =====================
    // LOGIN
    // =====================
   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        $division = Auth::user()->division->name;

        if ($division == 'AC') {
            return redirect('/dashboard/ac');
        }

        if ($division == 'Curriculum') {
            return redirect('/dashboard/curriculum');
        }

        if ($division == 'MKLT') {
            return redirect('/dashboard/mklt');
        }

        if ($division == 'MKWK') {
            return redirect('/dashboard/mkwk');
        }

        return redirect('/login');
    }

    return back()->with('error', 'Email atau password salah');
}

    // =====================
    // LOGOUT 
    // =====================
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}