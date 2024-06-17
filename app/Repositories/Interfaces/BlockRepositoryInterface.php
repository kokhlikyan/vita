<?php

namespace App\Repositories\Interfaces;

interface BlockRepositoryInterface
{
    public function all(int $user_id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id, $user_id);

}
