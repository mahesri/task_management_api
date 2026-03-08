<?php

namespace App\Services;


use App\Repositories\TaskRepository;
use App\Services\Interfaces\TaskServiceInterface;
use http\Client\Response;

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
        $data = [];

            foreach ($tasks as $task) {

                    $data[] = [
                        "title" => $task->title,
                        "description" => $task->description,
                        "status" => $task->status,
                        "due_date" => $task->due_date,
                    ];
                }

            if (count($data) > 0) {

                $message = "Data retrieved successfully";
            } else {

                $message = "Data is empty";
            }

            return [
                "success" => true,
                "message" => $message,
                "data" => $data
            ];
    }

    public function addTask($data): array
    {

         $result = $this->taskRepository->store($data);

         if($result){

             return [
                 "success" => true,
                 "message" => "Task stored successfully"
             ];

         } else {
             return [
                 "success" => false,
                 "message" => "An error occur!"
             ];
         }
    }

    public function editTask($id) :array
    {
        $task = $this->taskRepository->find($id);

        $returnTask = [
            'title' => $task['title'],
            'description' => $task['description'],
            'status' => $task['status'],
            'due_date' => $task['due_date'],
        ];

        return $returnTask;
    }

    public function updateTask($data, $id): array
    {

        $result = $this->taskRepository->update($data, $id);
        return  [
            'success' => $result,
            'message' => 'Task edited successfully'
        ];
    }

    public function deleteTask($id): void
    {
        $this->taskRepository->destroy($id);
    }

}
