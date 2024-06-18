<?php

namespace App\Repositories;

use App\Enums\TaskListOrderByValues;
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
        return Task::query()->find($id)->delete();
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

    public function list($sortDayCount, $user_id): Collection|array
    {
        $query = Task::query()
            ->leftJoin('recurrences', 'tasks.id', '=', 'recurrences.task_id')
            ->where('tasks.user_id', $user_id)
            ->select([
                'tasks.id',
                'tasks.title',
                'tasks.start_date as task_start_date',
                'tasks.completed',
                'recurrences.end_date as recurrence_end_date',
                'recurrences.recurrence_type',
                'recurrences.interval',
                'recurrences.exceptions',
                'recurrences.day_of_week',
                'recurrences.day_of_month',
                'recurrences.month_of_year',

            ]);

        if ($sortDayCount === 1) {
            $query->whereBetween('tasks.start_date', [now()->startOfDay(), now()->endOfDay()]);
        } else {
            $query
                ->where(function ($query) use ($sortDayCount) {
                    $query->where('recurrences.end_date', '>=', now()->startOfDay())
                        ->orWhereNull('recurrences.end_date')
                        ->whereBetween('tasks.start_date', [now()->startOfDay(), now()->addDays($sortDayCount)->endOfDay()]);
                });

        }


        return $query->get();
    }


}
