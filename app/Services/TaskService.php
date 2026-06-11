<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use App\Services\Interfaces\TaskServiceInterface;

class TaskService implements TaskServiceInterface
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTask() : array
    {
        $tasks = $this->taskRepository->getAll();
        return $tasks;
    }

    public function addTask($data): bool
    {
         $result = $this->taskRepository->create($data);
         isset($result) === true ? $return = true : $return = false;
         return $return;
    }

    public function getTask($id)
    {
        $task = $this->taskRepository->find($id);

          is_object($task) === true ? $returnTask = [
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->status,
            'due_date' => $task->due_date,
        ] : $returnTask = false;

        return $returnTask;
    }

    public function updateTask($data, $id): int
    {
        return $this->taskRepository->update($data, $id);
    }
    public function deleteTask($id) : bool
    {
        return $this->taskRepository->destroy($id);
    }

}
