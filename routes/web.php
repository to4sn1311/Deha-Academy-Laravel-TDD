<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', [TaskController::class, 'index'])
    ->name('tasks.index');

Route::post('/tasks', [TaskController::class, 'store'])
    ->name('tasks.store')
    ->middleware('auth');

Route::get('/tasks/create', [TaskController::class, 'create'])
    ->name('tasks.create')
    ->middleware('auth');

## add destroy route
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Auth::routes();
