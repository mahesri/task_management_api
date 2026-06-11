<?php

namespace App\Repositories\Interfaces;

use App\Models\Task;

interface TaskRepositoryInterface
{

    public function getAll() :array;

    public function find($id);

    public function create($data): Task;

    public function destroy($id) : ?bool;

    public function update($data, $id) : int;

}
