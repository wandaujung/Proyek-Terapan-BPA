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


    // =====================
    // LOGIN
    // =====================
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            if (!$user->division) {
                Auth::logout();
                return back()->with('error', 'Akun Anda belum ditugaskan ke divisi apa pun. Silakan hubungi Manager.');
            }

            $division = $user->division->name;

            if ($division == 'AC') {
                return redirect('/dashboard/ac');
            }

            if ($division == 'Manager') {
                return redirect('/dashboard/manager');
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