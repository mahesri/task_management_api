<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TaskRepository implements TaskRepositoryInterface
{

    public function getAll() :array
    {
        $tasks = Task::all();
        $returnTask = [];

        foreach ($tasks as $task) {
            $returnTask[] = [
                "title" => $task->title,
                "description" => $task->description,
                "status" => $task->status,
                "due_date" => $task->due_date,
            ];
        }
        return $returnTask;
    }

    public function find($id)
    {
        $data = DB::table('tasks')->where('id', $id)->first();
        return $data;
    }

    public function create($data) : Task
    {
        return Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'due_date' => $data['due_date'],
        ]);
    }

    public function destroy($id) : ?bool
    {
        try {
            $task = Task::find($id);
            $success = $task->delete();
        }catch (\Throwable $e){
            $success = $e->getPrevious();
        }
            $result = $success ?? false;
            return $result;
    }

    public function update($data, $id) : int
    {
       return DB::table('tasks')
            ->where('id', $id)
            ->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status'],
                'due_date' => $data['due_date'],
            ]);
    }

}
