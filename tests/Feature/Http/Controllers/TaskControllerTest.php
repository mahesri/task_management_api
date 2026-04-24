<?php


namespace Tests\Feature\Http\Controllers;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    protected function setUp(): void
    {
       parent::setUp();
    }

    public function test_getAllTask()
    {
        $response = $this->get('/api/tasks');
        $response->assertStatus(200);
        self::assertIsObject($response);
    }

    public function test_failRequestGetTasks()
    {

        $response = $this->get('/api/tasks');
        $response->assertExactJson([
            "success" => false,
            "message" => "Data is empty",
            "data" => []
        ]);
    }

    #[DataProvider('new_task')]
    public function test_user_can_create_task($task)
    {

        $response = $this->postJson('/api/tasks',
        data:$task
        );

//        $response->assertStatus(201)->assertJson([
//            "success" => true,
//            "message" => "Task stored successfully"
//        ]);
    }

    public static function new_task(): array
    {
        return [[[
            'title' => 'Focus finishing the clean architecture API',
            'description' => "Slow but sure, this journey isn't sprint but marathon",
            'status' => 'todo',
            'due_date' => '2026-03-20 08:17:0'
        ]]];
    }

    #[TestWith([14])]
    public function test_delete_task($id)
    {
        $response = $this->delete("/api/tasks/$id");
        $response->assertStatus(500);
    }

    #[DataProvider('updated_task')]
    public function test_user_can_update_data($data, $id)
    {

        $response = $this->put("/api/tasks/$id", $data);
        $response->assertStatus(202);
        self::assertEquals('Data updated successfully', $response['message']);
        self::assertEquals(true, $response['success']);
    }

    public static function updated_task() : array
    {
        return [[[
        'title' => 'Remember do not only focus on the surface D',
        'description' => "this time asking you to be receptive",
        'status' => 'todo',
        'due_date' => '2026-03-21 17:30:0'
        ],39
            ]];
    }

    #[TestWith([35])]
    public function test_userCanDeleteTask($id)
    {
        $response = $this->delete("/api/tasks/$id");
        $response->assertStatus(201);
    }

    #[TestWith([1])]
    public function test_userCanotDeleteTask($id)
    {
        $response = $this->delete("/api/tasks/$id");
        $response->assertStatus(422);
    }
}
