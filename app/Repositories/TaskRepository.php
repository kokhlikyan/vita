<?php

namespace App\Repositories;

use App\Enums\TaskListOrderByValues;
use App\Models\Block;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskRepositoryInterface
{

    public function all(int $user_id, $search, $page): LengthAwarePaginator
    {
        $task =  Task::query()
            ->where('user_id', $user_id)
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%$search%");
            });
        return $task->paginate($page);
    }

    public function create(array $data): Model|Builder
    {
        return Task::query()->create($data);
    }

    public function update(array $data, $id): bool|int
    {
        return Task::query()->find($id)->update($data);
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

        $taskQuery = Task::query()
            ->where('tasks.user_id', $user_id)
            ->leftJoin('recurrences', 'tasks.id', '=', 'recurrences.task_id')
            ->doesntHave('block')
            ->when($sortDayCount === 1, function ($query) {
                $query->whereBetween('tasks.start_date', [now()->startOfDay(), now()->endOfDay()]);
            })
            ->when($sortDayCount > 1, function ($query) use ($sortDayCount) {
                $query->whereBetween('tasks.start_date', [now()->startOfDay(), now()->addDays($sortDayCount)->endOfDay()])
                    ->where(function ($query) use ($sortDayCount) {
                        $query->where('recurrences.end_date', '>=', now()->startOfDay())
                            ->orWhereNull('recurrences.end_date')
                            ->whereBetween('tasks.start_date', [now()->startOfDay(), now()->addDays($sortDayCount)->endOfDay()]);
                    });
            })
            ->with('recurrence')
            ->select('tasks.*');

        $blockQuery = Block::query()
            ->where('blocks.user_id', $user_id)
            ->with(['tasks' => function ($query) use ($sortDayCount) {
                $query->leftJoin('recurrences', 'tasks.id', '=', 'recurrences.task_id')
                    ->when($sortDayCount === 1, function ($query) {
                        $query->whereBetween('tasks.start_date', [now()->startOfDay(), now()->endOfDay()]);
                    })
                    ->when($sortDayCount > 1, function ($query) use ($sortDayCount) {
                        $query->whereBetween('tasks.start_date', [now()->startOfDay(), now()->addDays($sortDayCount)->endOfDay()])
                            ->where(function ($query) use ($sortDayCount) {
                                $query->where('recurrences.end_date', '>=', now()->startOfDay())
                                    ->orWhereNull('recurrences.end_date')
                                    ->whereBetween('tasks.start_date', [now()->startOfDay(), now()->addDays($sortDayCount)->endOfDay()]);
                            });
                    })
                    ->with('recurrence')
                    ->select('tasks.*');
            }]);

        return [
            'tasks' => $taskQuery->get(),
            'blocks' => $blockQuery->get()
        ];
    }


}
