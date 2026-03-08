<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    private $taskService;

    /**
     * @param $taskRepository
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $tasks = $this->taskService->getAllTask();

       return response()->json([
          'success' => $tasks['success'],
          'message' => $tasks == true ? $tasks['message'] : false ,
          'data' => $tasks['data']
           ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {

        $result = $this->taskService->addTask($request);

        return response()->json([
            'success' => $result['success'],
            'message' => $result['message']
        ], 201);
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = $this->taskService->editTask($id);
        return response()->json([
            'success' => 'success',
            'message' => "Task retrieved successfully",
            'data' => $task
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $result = $this->taskService->updateTask($request, $id);
        return response()->json($result, 201);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $this->taskService->deleteTask($id);
        return response()->json(status: 204);
    }
}
