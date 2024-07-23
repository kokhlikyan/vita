<?php

namespace App\Repositories;
use App\Models\Goal;
use App\Repositories\Interfaces\GoalRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GoalRepository implements  GoalRepositoryInterface
{
    public function all(int $user_id): Collection
    {
        return Goal::query()
            ->join('tasks', 'goals.id', '=', 'tasks.goal_id')
            ->where('goals.user_id', $user_id)
            ->orderBy('tasks.start_date')
            ->select('goals.*')
            ->get();
    }

    public function create(array $data): Model|Builder
    {
        return Goal::query()->create($data);
    }

    public function update(array $data, $id): bool
    {
        return Goal::query()->find($id)->update($data);
    }

    public function delete($id): int
    {
        return Goal::destroy($id);
    }

    public function find($id, $user_id): Model|Collection|Builder|null
    {
        return Goal::query()->where('user_id', $user_id)->find($id);
    }

}
