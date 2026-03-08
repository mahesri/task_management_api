<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{

    public function getAll();

    public function find($id) : object;

    public function store($data);

    public function destroy($id);

    public function update($data, $id) : bool;

}
