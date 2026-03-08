<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Support\Facades\DB;


class TaskRepository implements TaskRepositoryInterface
{

    public function getAll()
    {
        $tasks = Task::all();
        return $tasks;

    }

    public function find($id) : object
    {

        $task = Task::findOrFail($id);
        return $task;

    }

    public function store($data)
    {

        if(
        Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'due_date' => $data['due_date'],
        ])
        ){
            return true;
        }else {
            return false;
        }

    }

    public function destroy($id)
    {

        DB::table('tasks')->where('id', $id)->delete();
    }

    public function update($data, $id) :bool
    {
       $result =  DB::table('tasks')
            ->where('id', $id)
            ->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status'],
                'due_date' => $data['due_date'],
            ]);

       if ($result){

        return true;
       } else {

           return false;
       }
    }
}
