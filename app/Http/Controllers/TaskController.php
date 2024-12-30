<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index()
    {
        $tasks = Task::paginate(30);
        return view('tasks.index', compact('tasks'));
    }

    public function store(CreateTaskRequest $request)
    {
        $this->task->create($request->all());
        return redirect()->route('tasks.index');
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

}
