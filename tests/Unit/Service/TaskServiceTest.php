<?php

namespace Tests\Unit\Service;

use App\Repositories\TaskRepository;
use App\Services\TaskService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{

    private TaskService $taskService;

    protected function setUp(): void
    {
        parent::setUp();
        $taskRepository = new TaskRepository();
        $this->taskService = new TaskService($taskRepository);
    }

    public function test_getAllTasks()
    {
        $tasks = $this->taskService->getAllTask();
        self::assertIsArray($tasks);
    }

    #[TestWith([
        [
            "title" => "Buying stuff for Atap Langit Orphanage",
            "description" => "Fill empty stuff",
            "status" => "todo",
            "due_date" => "2026-03-16 01:43:57",
        ]])]
    public function test_addTask($data)
    {
       $result = $this->taskService->addTask($data);
       self::assertEquals('{
                "success": true,
                "message": "Task stored successfully"
       }', $result);
    }

    #[DataProvider('updatedTask')]
   public function test_updateData($data, $id)
    {
        $result = $this->taskService->updateTask($data, $id);
        self::assertIsInt(1, $result);
    }

    public static function updatedTask() : array
    {

        return [[[
            "title" => "No move hard, just move smarter",
            "description" => "More focused and consistent",
            "status" => "todo",
            "due_date" => "2026-03-18 01:43:57",
        ], 44]];
    }

    #[TestWith([1])]
    public function test_deleteTask($id) {
    $result = $this->taskService->deleteTask($id);
    self::assertIsBool($result);
    }
}
