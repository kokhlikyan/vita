<?php

namespace App\Repositories;
use App\Models\Goal;
use App\Repositories\Interfaces\GoalRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GoalRepository implements  GoalRepositoryInterface
{
    public function all(): Collection
    {
        return Goal::all();
    }

    public function create(array $data)
    {
        return Goal::query()->create($data);
    }

    public function update(array $data, $id): bool
    {
        return Goal::query()->find($id)->update($data);
    }

    public function delete($id)
    {
        return Goal::destroy($id);
    }

    public function find($id)
    {
        return Goal::find($id);
    }

    public function findOwn($id, $user_id)
    {
        return Goal::query()->where('user_id', $user_id)->find($id);
    }
}
