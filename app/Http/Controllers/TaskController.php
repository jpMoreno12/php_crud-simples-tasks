<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ITask;
use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(int $authUserId)
    {
        $tasks = $this->taskService->getAllTasks( $authUserId);

        return response()->json($tasks);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,done',
        ]);
        

        $authUserId = 1;

        $task = $this->taskService->createTask($validatedData, $authUserId);

        return response()->json([
            'message' => 'Task was created',
            'task' => $task,
        ], 201);
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:pending,in_progress,done',
        ]);

        $authUserId = 1;

        $task = $this->taskService->updateTask($id, $validatedData, $authUserId);

        return response()->json($task);
    }

    public function destroy(int $id)
    {
        $authUserId = 1;

        $response = $this->taskService->deleteTask($id, $authUserId);

        return response()->json($response);
    }
}
