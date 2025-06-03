<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequests\StoreTaskRequest;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\TaskRequests\UpdateTaskRequest;


class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $tasks = $this->taskService->getAllTasks($user->id);

        return response()->json($tasks);
    }


    public function store(StoreTaskRequest $request)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }
        
        $validatedData = $request->validated();
        $task = $this->taskService->createTask($validatedData, $user->id);

        return response()->json([
            'message' => 'Task was created',
            'task' => $task,
        ], 201);
    }


    public function update(UpdateTaskRequest $request, int $id)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Usuário não autenticado'], 401);
        }
        $validatedData = $request->validated();

        try {
            $task = $this->taskService->updateTask($id, $validatedData, $user->id);
            return response()->json($task);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id)
    {
        $authUserId = 1;

        $response = $this->taskService->deleteTask($id, $authUserId);

        return response()->json($response);
    }
}
