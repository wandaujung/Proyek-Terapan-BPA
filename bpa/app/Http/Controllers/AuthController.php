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
        $divisions = Division::all();
        return view('auth.register', compact('divisions'));
    }

    // =====================
    // REGISTER
    // =====================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'division_id' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'division_id' => $request->division_id
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
            return redirect('/dashboard');
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