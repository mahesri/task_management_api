<?php

namespace Tests\Unit\Repository;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;
use App\Repositories\TaskRepository;
use function PHPUnit\Framework\assertIsObject;

class TaskRepositoryTest extends TestCase
{

    private TaskRepository $taskRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->taskRepository = new TaskRepository();
    }

    public function test_getAllData()
    {
        $result = $this->taskRepository->getAll();
        self::assertIsArray($result);
    }

    #[DataProvider('todo_data')]
    public function test_createData($todo)
    {
        $result = $this->taskRepository->create($todo);
        self::assertIsObject($result);
    }

    public static function todo_data(): array
    {

        return [[[
            "title" => "Does erla todo",
            "description" => "focus, isn't regular year",
            "status" => "todo",
            "due_date" => "2026-03-16 01:43:57",
        ]]];
    }

    #[TestWith([21])]
    public function test_findData($id)
    {
        $result = $this->taskRepository->find($id);
        self::assertIsObject($result);
    }

    #[TestWith([32])]
    public function test_cannotFindData($id)
    {
        $result = $this->taskRepository->find($id);
        assertIsObject($result);
    }

    #[DataProvider('updated_todo')]
    public function test_updateData($updated_todo, $id)
    {
        $result = $this->taskRepository->update($updated_todo, $id);
        self::assertIsInt($result);
        self::assertEquals(actual: $result, expected: 1);
    }

    #[DataProvider('updated_todo')]
    public function test_cannotUpdateData($updated_todo, $id)
    {
        $result = $this->taskRepository->update($updated_todo, $id);
        self::assertIsInt($result);
        self::assertIsBool(false);
        self::assertEquals(actual: $result, expected: 0);
    }

    public static function updated_todo()
    {
        return [[[
            "title" => "Go to aunty pony",
            "description" => "Respect her she is family",
            "status" => "todo",
            "due_date" => "2026-03-16 01:43:57",
        ], 33]];
    }

    #[TestWith([31])]
    public function test_deleteData($id) {
        $result = $this->taskRepository->destroy($id);
        self::assertIsInt($result);
        self::assertEquals(actual: $result, expected: 1);
    }

    #[TestWith([1])]
    public function test_cannotDeleteData($id)
    {
    $result = $this->taskRepository->destroy($id);
    self::assertIsBool(is_null($result));
    }


}


