<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

Route::get('/', function () {
    return view('index', [
        'tasks' => Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('/create', 'create')
->name('tasks.create');

Route::get('/{task}/edit', function (Task $task) {
  return view('edit', [
    'task' => $task
  ]);
})->name('tasks.edit');

Route::get('/{task}', function (Task $task) {
  return view('show', [
    'task' => $task
  ]);
})->name('tasks.show');

Route::post('/', function (TaskRequest $request){
  $task = Task::create($request->validated());

  return redirect()->route('tasks.show', ['task' => $task->id])
  ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::put('/{task}', function (Task $task, TaskRequest $request){
  $data = $request->validated();
  $task->update($data);

  return redirect()->route('tasks.show', ['task' => $task->id])
  ->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::delete('/{task}', function (Task $task){
  $task->delete();

  return redirect()->route('tasks.index')
  ->with('success', 'Task deleted successfully!');
})->name('tasks.destroy');

// Route::get('/about', function () {
//     return 'About Page';
// })->name('about');

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello '. $name ."!";
// });

// Route::get('/not-found', function () {
//     return redirect()->route('about');
// });

// Route::fallback(function () {
//     return '404 Not Found';
// });