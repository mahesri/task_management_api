<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;

class TaskController extends Controller
{

    private $taskService;


    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function getTasks()
    {
        $tasks = $this->taskService->getAllTask();

            if (count($tasks) > 0) {
                $message = "Data retrieved successfully";
            } else {
                $message = "Data is empty";
            }

        return response()->json([
            'success' => $tasks == true ? true : false,
            'message' => $message,
            'data' => $tasks
        ]);
    }

    public function store(StoreTaskRequest $request)
    {
        $result = $this->taskService->addTask($request);
        return response()->json([
            'success' => $result,
            'message' => $result === true ? "Data stored successfully" : "Server error"
        ], status: $result === true ? 201 : 500);
    }

    public function edit(string $id)
    {

    }

    public function show(string $id)
    {
        $task = $this->taskService->getTask($id);

        if ($task) {

            return response()->json([
                'success' => 'success',
                'message' => "Task retrieved successfully",
                'data' => $task
            ]);

        } else {
            return response()->json(status: 204);
        }
    }

    public function update(UpdateTaskRequest $request, string $id)
    {

        $result = $this->taskService->updateTask($request, $id);
        return response()->json(["success" => $result === 1 ? true : false,
                          "message" => $result === 1 ? "Data updated successfully" : "Unprocessable Content"
            ], status: $result === 1 ? 202 : 422
        );
    }

    public function destroy(string $id)
    {
        $response = $this->taskService->deleteTask($id);

        return response()->json(
            status: $response === true ? 201 : 422,
        );
    }
}
