@extends('layouts.app')

@section('content')

    <h4>
        <a href="{{ route('task.create') }}">Create New Task</a>
    </h4>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Task Name</th>
            <th>Priority</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody id="sortable-list">
        @foreach ($tasks as $task)
            <tr data-task-id="{{ $task->priority }}">
                <td><a href="{{ route('task.show', $task->id) }}">{{ $task->name }}</a></td>
                <td>{{$task->priority}}</td>
                <td>{{\Carbon\Carbon::create($task->created_at)->toDateString()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
        const sortableList = new Sortable(document.getElementById('sortable-list'), {
            animation: 150,
            onUpdate: function (evt) {
                const taskRows = Array.from(document.querySelectorAll('#sortable-list tr'));
                const taskIds = taskRows.map(row => row.getAttribute('data-task-id'));

                axios.post('{{ route('task.updatePriority') }}', {
                    taskIds: taskIds
                }).then(response => {
                    console.log(response.data);
                }).catch(error => {
                    console.error(error);
                });
            }
        });
    </script>
@endsection
