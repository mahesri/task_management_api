<?php

namespace App\Services\Interfaces;

use App\Models\Task;

interface TaskServiceInterface
{

    public function getAllTask(): array;

    public function addTask($data) : bool;

    public function getTask($id);

    public function updateTask($data ,$id) : int;

    public function deleteTask($id) : bool;
}
