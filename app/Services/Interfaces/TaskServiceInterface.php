<?php

namespace App\Services\Interfaces;

interface TaskServiceInterface
{

    public function getAllTask(): array;

    public function addTask($data) : array;

    public function editTask($id) : array;

    public function updateTask($data ,$id) : array;

    public function deleteTask($id) : void;
}
