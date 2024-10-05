@extends('layouts.app')

@section('title', $task->title)

@section('content')

<div class="mb-4">
    <a class="font-medium text-gray-700 underline" href="{{ route('tasks.index') }}">Go back to task list!</a>
</div>

<p class="mb-4 text-slate-700">{{$task->description}}</p>
@if ($task->long_description)
    <p class="mb-4 text-slate-700">{{$task->long_description}}</p>
@endif
<p class="mb-4 text-sm text-slate-500">Created: {{ $task->created_at->diffForHumans() }} -- Updated: {{ $task->updated_at->diffForHumans() }}</p>

<p class="mb-4">
    @if ($task->completed)
        <span class="font-medium text-green-500">Task completed</span>
    @else
        <span class="font-medium text-red-500">Task incomplete</span>
    @endif
</p>

<div class="flex">
    <a class="btn" href="{{ route('tasks.edit', ['task' => $task])}}">Edit</a>

    <form method="POST" action="{{ route('tasks.complete', ['task' => $task]) }}">
        @csrf
        @method('PUT')
        <button class="btn" type="submit">
            Mark as {{ $task->completed ? 'incomplete' : 'complete'}}
        </button>
    </form>

    <form 
        action="{{ route('tasks.destroy', ['task' => $task->id])}}"
        method="POST">
        @csrf
        @method('DELETE')
        <button class="btn" type="submit">Delete</button>
    </form>
</div>
@endsection
