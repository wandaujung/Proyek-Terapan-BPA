<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

use App\Http\Controllers\StaffDashboardController;

Route::get('/dashboard/ac', [StaffDashboardController::class, 'show'])
    ->middleware('auth');

Route::get('/dashboard/curriculum', [StaffDashboardController::class, 'show'])
    ->middleware('auth');

Route::get('/dashboard/mklt', [StaffDashboardController::class, 'show'])
    ->middleware('auth');

Route::get('/dashboard/mkwk', [StaffDashboardController::class, 'show'])
    ->middleware('auth');


Route::get('/dashboard', function () {
    return "dashboard";
})->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

Route::middleware([
    'auth',
    'manager'
])->group(function () {
    Route::get('/dashboard/manager', [ManagerController::class, 'dashboard'])
        ->name('manager.dashboard');

    Route::get('/dashboard/manager/projects', [ManagerController::class, 'projects'])
        ->name('manager.projects.index');

    Route::get('/dashboard/manager/reviews', [ManagerController::class, 'reviews'])
        ->name('manager.reviews');

    Route::get('/dashboard/manager/reviews/{task}', [ManagerController::class, 'reviewDetail'])
        ->name('manager.review_detail');

    Route::post('/dashboard/manager/projects', [ManagerController::class, 'storeProject'])
        ->name('manager.projects.store');

    Route::get('/dashboard/manager/staff', [ManagerController::class, 'staffManagement'])
        ->name('manager.staff_management');

    Route::post('/dashboard/manager/staff', [ManagerController::class, 'storeStaff'])
        ->name('manager.staff_management.store');

    Route::get('/dashboard/manager/staff/export', [ManagerController::class, 'exportStaff'])
        ->name('manager.staff_management.export');

    Route::delete('/dashboard/manager/staff/{user}', [ManagerController::class, 'deleteStaff'])
        ->name('manager.staff_management.delete');

    Route::post('/dashboard/manager/staff/import', [ManagerController::class, 'importStaff'])
        ->name('manager.staff_management.import');

    Route::get('/dashboard/manager/staff/template', [ManagerController::class, 'downloadTemplate'])
        ->name('manager.staff_management.template');
});


    
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

    Route::post('/tasks/store',
    [TaskController::class,'store'])
    ->name('tasks.store');

Route::put('/tasks/update/{task}',
    [TaskController::class,'update'])
    ->name('tasks.update');

Route::post('/tasks/submit/{task}',
    [TaskController::class,'submit'])
    ->name('tasks.submit');

Route::post('/projects/{project}/submit-reviews',
    [TaskController::class,'submitBatch'])
    ->name('projects.submit_reviews');

Route::get('/notifications', [NotificationController::class, 'index'])
    ->middleware('auth')
    ->name('notifications.index');

Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
    ->middleware('auth')
    ->name('notifications.read');

Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
    ->middleware('auth')
    ->name('notifications.readAll');

Route::post('/tasks/approve/{task}',
    [TaskController::class,'approve'])
    ->name('tasks.approve');

Route::post('/tasks/revision/{task}',
    [TaskController::class,'revision'])
    ->name('tasks.revision');

Route::post('/tasks/status/{task}',
    [TaskController::class,'updateStatus'])
    ->name('tasks.status');