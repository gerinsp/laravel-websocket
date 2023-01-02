<?php

use App\Models\Task;
use App\Events\TaskStatusUpdated;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', function () {
    return Task::latest()->pluck('body');
});

Route::post('/tasks', function () {
    $task = Task::forceCreate(request(['body']));

    event(new TaskStatusUpdated($task));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
