<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('priority', 'ASC')->get();
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'priority' => 'required|integer',
        ]);

        Task::create([
            'name' => $request->input('name'),
            'priority' => $request->input('priority'),
        ]);

        return redirect()->route('task.index')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateTaskRequest $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'priority' => 'required|integer',
        ]);

        $task->update([
            'name' => $request->input('name'),
            'priority' => $request->input('priority'),
        ]);

        return redirect()->route('task.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('task.index')->with('success', 'Task deleted successfully');
    }
    public function updatePriority(Request $request)
    {
        $taskIds = $request->input('taskIds');
        $priority = count($taskIds);

        foreach ($taskIds as $taskId) {
            Task::where('id', $taskId)->update(['priority' => $priority]);
            $priority--;
        }

        return response()->json(['message' => 'Priority updated successfully']);
    }
}
