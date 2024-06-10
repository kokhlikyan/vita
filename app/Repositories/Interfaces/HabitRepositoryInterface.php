<?php

namespace App\Repositories\Interfaces;

interface HabitRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function findOwn($id, $user_id);
}
