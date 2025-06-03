<?php

namespace App\Repositories;
use App\Models\Task;
use App\Repositories\Contracts\ITask;
class TaskRepository implements ITask {
    public Task $task;  

    public function __construct(Task $task) {
        $this->task = $task;
    }

    public function createTask(array $task) {
        return $this->task->create($task);
    }

    public function getAllTasks(int $user_id){
        return $this->task->where('user_id', $user_id)->get();
    }

    public function getTask(int $id){
        return $this->task->find($id);
    }

    public function updateTask(int $id, array $data){ 
        $task = $this->task->find($id);
        if($task) {
            $task->update($data);
            return $task;
        }
        return false;
    }

    public function deleteTask(int $id){
        $task = $this->task->find($id);

        if($task) {
            return $task->delete();
        }
        return false;
    }

}
