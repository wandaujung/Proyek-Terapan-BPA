<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;

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


Route::get('/projects', [ProjectController::class, 'index'])
    ->middleware('auth')
    ->name('projects');

Route::post('/projects', [ProjectController::class, 'store'])
    ->middleware('auth')
    ->name('projects.store');

Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])
    ->middleware('auth')
    ->name('projects.edit');

Route::put('/projects/update/{id}', [ProjectController::class, 'update'])
    ->middleware('auth')
    ->name('projects.update');

Route::delete('/projects/delete/{id}', [ProjectController::class, 'destroy'])
    ->middleware('auth')
    ->name('projects.destroy');

    Route::get('/projects/{id}/tasks', [ProjectController::class, 'tasks'])
    ->middleware('auth')
    ->name('projects.tasks');