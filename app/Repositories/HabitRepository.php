<?php

namespace App\Repositories;
use App\Models\Habit;
use App\Repositories\Interfaces\HabitRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class HabitRepository implements  HabitRepositoryInterface
{
    public function all(int $user_id): Collection
    {
        return Habit::query()
            ->join('tasks', 'habits.id', '=', 'tasks.goal_id')
            ->where('habits.user_id', $user_id)
            ->orderBy('tasks.start_date')
            ->select('habits.*')
            ->get();
    }

    public function create(array $data): Model|Builder
    {
        return Habit::query()->create($data);
    }

    public function update(array $data, $id): bool
    {
        return Habit::query()->find($id)->update($data);
    }

    public function delete($id): bool
    {
        return Habit::destroy($id);
    }

    public function find($id, $user_id): Builder|Collection|Model|null
    {
        return Habit::query()->where('user_id', $user_id)->find($id);
    }
}
