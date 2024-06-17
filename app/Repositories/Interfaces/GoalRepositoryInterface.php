<?php

namespace App\Repositories\Interfaces;

interface GoalRepositoryInterface
{
    public function all(int $user_id);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function find(int $id, int $user_id);
}
