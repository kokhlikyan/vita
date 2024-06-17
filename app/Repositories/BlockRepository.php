<?php

namespace App\Repositories;

use App\Models\Block;
use App\Repositories\Interfaces\BlockRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BlockRepository implements BlockRepositoryInterface
{

    public function all(int $user_id): Collection
    {
        return Block::query()->where('user_id', $user_id)->get();
    }

    public function create(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return Block::query()->create($data);
    }

    public function update(array $data, $id): bool
    {
        return Block::query()->find($id)->update($data);
    }

    public function delete($id): bool
    {
        return Block::destroy($id);
    }

    public function find($id, $user_id): Model|Collection|Builder|array|null
    {
        return Block::query()->where('user_id', $user_id)->find($id);
    }

}
