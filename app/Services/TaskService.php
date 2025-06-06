<?php

namespace App\Services;

use App\Repositories\Contracts\ITask;

class TaskService
{
    private ITask $taskRepository;

    public function __construct(ITask $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function createTask(array $data, int $authUserId)
    {
        $data['user_id'] = $authUserId;

        return $this->taskRepository->createTask($data);
    }

    public function getAllTasks(int $authUserId)
    {
        $task = $this->taskRepository->getAllTasks($authUserId);

        return $task;
    }

    public function updateTask(int $id, array $data, int $authUserId)
    {
        $task = $this->taskRepository->getTask($id);

        if (!$task) {
            throw new \Exception('Task não encontrada');
        }

        if ($task->user_id !== $authUserId) {
            throw new \Exception('Usuário não autorizado');
        }

        $updatedTask = $this->taskRepository->updateTask($id, $data);
        return $updatedTask;
    }


    public function deleteTasks(int $id, int $authUserId)
    {
        $task = $this->taskRepository->getTask($id);
        
        if ($task->user_id !== $authUserId) {
            throw new \Exception('user not found');
            dd('usuario nao encontrado');
        }

        return $this->taskRepository->deleteTask($id);
    }
}
