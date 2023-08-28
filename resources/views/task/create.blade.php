@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Task</h2>
        <form action="{{ route('task.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="priority">Priority:</label>
                <input type="number" class="form-control" id="priority" name="priority" value="{{ old('priority') }}">
            </div>

            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>
@endsection
