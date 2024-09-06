<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BlockRepositoryInterface
{
    public function all(int $user_id);

    public function create(array $data);

    public function update(array $data, $id): Builder|array|Collection|Model;

    public function delete($id, $data);

    public function find($id, $user_id);

    public function filteredByDate(int $user_id, string $date, int $sort, string $type): Builder|array|Collection|Model;

}
