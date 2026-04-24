<?php

use \App\Models\Task;
use Illuminate\Support\Facades\DB;
use \PHPUnit\Framework\Attributes;
class TaskModelTest extends \Tests\TestCase {

    private Task $task;
    protected function setUp() : void
    {
        parent::setUp();
        $this->task = new Task();
    }

    #[Attributes\DataProvider('data_todo')]
    public function test_store($data_todo)
    {
        Task::create($data_todo);
    }

    public static function data_todo()
    {
        return [[[
            "title" => "Contacting her for a proposition",
            "description" => "Make a progress even 1%",
            "status" => "todo",
            "due_date" => "2026-03-16 01:43:57",
        ]]];
    }

    #[Attributes\TestWith([41])]
    public function test_find_data($id)
    {
        $result = Task::find($id);
        self::assertIsObject($result);
    }

    #[Attributes\TestWith([1])]
    public function test_cannotFindData($id)
    {
        $result = Task::find($id);
        self::assertIsBool(is_null($result));
    }

    #[Attributes\DataProvider('data_updatedTodo')]
    public function test_updateData($data_todo, $id)
    {
        $result = DB::table('tasks')
            ->where('id', $id)
            ->update([
                'title' => $data_todo['title'],
                'description' => $data_todo['description'],
                'status' => $data_todo['status'],
                'due_date' => $data_todo['due_date'],
            ]);
        self::assertEquals(1, $result);
    }

    #[Attributes\DataProvider('data_updatedTodo')]
    public function test_dataNotUpdated($data_todo, $id)
    {
        $result = DB::table('tasks')
            ->where('id', $id)
            ->update([
                'title' => $data_todo['title'],
                'description' => $data_todo['description'],
                'status' => $data_todo['status'],
                'due_date' => $data_todo['due_date'],
            ]);
        self::assertIsBool(is_null($result));
    }

    public static function data_updatedTodo()
    {
        return [[[
            "title" => "Contacting her for a proposition",
            "description" => "Done, now everything more clear we know her, and stay tide to the approach everything will occur simultaneously great thing require big sucrifice",
            "status" => "done",
            "due_date" => "2026-03-16 01:43:57",
        ],41 ]];
    }

    #[Attributes\TestWith([40])]
    public function  test_deleteTodo($id)
    {
        $result = DB::table('tasks')->where('id', $id)->delete();
        self::assertEquals(1, $result);
        self::assertIsInt(1, $result);
    }

    #[Attributes\TestWith([1])]
    public function test_cannotDestroyTodo($id)
    {
        $result = DB::table('tasks')->where('id', $id)->delete();
        self::assertEquals(0, $result);
        self::assertIsInt(0, $result);
    }
}
