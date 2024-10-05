<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Models\Task;

Route::get('/', function () {
    return view('index', [
        'tasks' => Task::latest()->get()
    ]);
})->name('tasks.index');

Route::get('/{id}', function ($id) {
  return view('show', [
    'task' => Task::findOrFail($id)
  ]);
})->name('tasks.show');

Route::get('/about', function () {
    return 'About Page';
})->name('about');

Route::get('/greet/{name}', function ($name) {
    return 'Hello '. $name ."!";
});

Route::get('/not-found', function () {
    return redirect()->route('about');
});

Route::fallback(function () {
    return '404 Not Found';
});