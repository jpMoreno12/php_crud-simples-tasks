<?php

namespace App\Repositories\Contracts;
interface ITask {
    public function createTask(array $task);
    public function getAllTasks(int $user_id);
    public function getTask(int $id);
    public function updateTask(int $id, array $data);
    public function deleteTask(int $id); 
}
