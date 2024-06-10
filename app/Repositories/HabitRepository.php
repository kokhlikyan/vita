<?php

namespace App\Repositories;
use App\Models\Habit;
use App\Repositories\Interfaces\HabitRepositoryInterface;

class HabitRepository implements  HabitRepositoryInterface
{
    public function all()
    {
        return Habit::all();
    }

    public function create(array $data)
    {
        return Habit::query()->create($data);
    }

    public function update(array $data, $id): bool
    {
        return Habit::query()->find($id)->update($data);
    }

    public function delete($id)
    {
        return Habit::destroy($id);
    }

    public function find($id)
    {
        return Habit::find($id);
    }

    public function findOwn($id, $user_id)
    {
        return Habit::query()->where('user_id', $user_id)->find($id);
    }
}
