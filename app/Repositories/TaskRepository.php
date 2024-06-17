<?php

namespace App\Repositories;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TaskRepository implements TaskRepositoryInterface
{

    public function all(int $user_id): Collection|array
    {
        return Task::query()->where('user_id', $user_id)->get();
    }

    public function create(array $data): Model|Builder
    {
        return Task::query()->create($data);
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function find($id, $user_id): Model|Collection|Builder|array|null
    {
        return Task::query()->where('user_id', $user_id)->find($id);
    }

    public function makeCompleted($id, $user_id): bool
    {
        $task = Task::query()
            ->where('user_id', $user_id)
            ->find($id);
        $task->completed = !$task->completed;
        return $task->save();
    }

    public function findAllWithBlock($user_id): Collection|array
    {
        return Task::query()
            ->where('user_id', $user_id)
            ->with('block')
            ->get();
    }
}
