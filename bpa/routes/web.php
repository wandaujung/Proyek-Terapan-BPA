<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard/ac', function () {
    return view('dashboard_ac');
})->middleware('auth');

Route::get('/dashboard/curriculum', function () {
    return view('dashboard_curriculum');
})->middleware('auth');

Route::get('/dashboard/mklt', function () {
    return view('dashboard_mklt');
})->middleware('auth');

Route::get('/dashboard/mkwk', function () {
    return view('dashboard_mkwk');
})->middleware('auth');

Route::get('/dashboard', function () {
    return "dashboard";
})->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/projects', function () {
    return view('projects');
})->name('projects');