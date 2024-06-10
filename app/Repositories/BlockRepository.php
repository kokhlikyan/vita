<?php

namespace App\Repositories;

use App\Models\Block;
use App\Repositories\Interfaces\BlockRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
class BlockRepository implements BlockRepositoryInterface
{

    public function all(): Collection
    {
        return Block::all();
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

    public function find($id)
    {
        return Block::query()->find($id);
    }
    public function findOwn($id, $user_id)
    {
        return Block::query()->where('id', $id)->where('user_id', $user_id)->first();
    }
}
