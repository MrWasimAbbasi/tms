@extends('layouts.app')

@section('content')
    <h2>{{ $task->name }}</h2>
    <p>Priority: {{ $task->priority }}</p>

    <a href="{{ route('task.edit', $task->id) }}">Edit</a>
    <form action="{{ route('task.destroy', $task->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Delete</button>
    </form>
@endsection
