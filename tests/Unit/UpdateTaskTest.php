<?php

namespace Tests\Unit;

use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\Attributes\DataProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    private \App\Services\TaskService $taskService;


    protected function setUp() : void
    {
        $taskRepository = new TaskRepository();
        $this->taskService = new TaskService($taskRepository);

    }

#[DataProvider('toDO')]
    public function testUpdate(array $data, int $id)
    {

        parent::setUp();
        $result = $this->taskService->updateTask($data, $id);

        $actualString = json_encode($result);
        dd($actualString);

    }

    public static function toDo()
    {
        $data = [
            [
            [ 'title' => 'Reporting to Ibu Bella',
              'description' => 'Tels about the calling with orphange AL and slb Marsudi II',
              'status' => 'done',
              'due_date' => "2026-03-09 08:17:0" ],
            8]
        ];
        return $data;
    }

    public function testAssertArray() {

        $data = [];

        self::assertIsArray($data);

    }

}
