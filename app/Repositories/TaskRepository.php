<?php

namespace App\Repositories;

use App\Enums\TaskListOrderByValues;
use App\Models\Block;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskRepositoryInterface
{

    public function all(int $user_id, $search, $page): LengthAwarePaginator
    {
        $task = Task::query()
            ->where('user_id', $user_id)
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%$search%");
            })->orderBy('urgent', 'desc');
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

    public function delete($id, $user_id): bool
    {
        $task = Task::query()->where('user_id', $user_id)->find($id);

        if (!$task) return false;

        return $task->delete();
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

     public function makeUrgent($id, $user_id): bool
    {
        $task = Task::query()
            ->where('user_id', $user_id)
            ->find($id);
        $task->urgent = !$task->urgent;
        return $task->save();
    }

    public function findAllWithBlock($user_id): Collection|array
    {
        return Task::query()
            ->where('user_id', $user_id)
            ->with('block')
            ->orderBy('urgent', 'desc')
            ->get();
    }

    public function list($sortDayCount, $date, $type, $user_id): Collection|array
    {
        $startOfDay = $date->copy()->startOfDay()->startOfDay();
        if ($sortDayCount > 1) {
            $endOfDay = $date->copy()->addDays($sortDayCount)->endOfDay()->endOfDay();
        } else {
            $endOfDay = $date->copy()->endOfDay()->endOfDay();
        }

        $taskQuery = Task::query()
            ->where('tasks.user_id', $user_id)
            ->doesntHave('block')
            ->when($sortDayCount, function ($query) use ($startOfDay, $endOfDay) {
                $query->whereBetween('start_date', [$startOfDay, $endOfDay]);
            })
            ->when($type === 'independent', function ($query) {
                $query->doesntHave('block')
                    ->doesntHave('goal')
                    ->doesntHave('habit');
            })
            ->when($type === 'block', function ($query) {
                $query->whereHas('block');
            })
            ->when($type === 'goal', function ($query) {
                $query->whereHas('goal');
            })
            ->when($type === 'habit', function ($query) {
                $query->whereHas('habit');
            })->orderBy('urgent', 'desc');

        $blockQuery = Block::query()
            ->where('blocks.user_id', $user_id)
            ->with(['tasks' => function ($query) use ($startOfDay, $endOfDay, $sortDayCount) {
                $query->when($sortDayCount, function ($query) use ($startOfDay, $endOfDay) {
                    $query->whereBetween('start_date', [$startOfDay, $endOfDay]);
                })->orderBy('urgent', 'desc');
            }])
            ->when($type === 'independent', function ($query) {
                $query->whereHas('tasks', function ($query) {
                    $query->doesntHave('block')
                        ->doesntHave('goal')
                        ->doesntHave('habit');
                });
            })
            ->when($type === 'block', function ($query) {
                $query->whereHas('tasks', function ($query) {
                    $query->whereHas('block');
                });
            })
            ->when($type === 'goal', function ($query) {
                $query->whereHas('tasks', function ($query) {
                    $query->whereHas('goal');
                });
            })
            ->when($type === 'habit', function ($query) {
                $query->whereHas('tasks', function ($query) {
                    $query->whereHas('habit');
                });
            });
        return [
            'tasks' => $taskQuery->get(),
            'blocks' => $blockQuery->get()
        ];
    }

    public function filteredTasks($params, $user_id): Collection|array
    {
        $startOfDay = Carbon::parse($params['date'])->startOfDay();
        $endOfDay = Carbon::parse($params['date'])->endOfDay();
        $taskQuery = Task::query()
            ->where('user_id', $user_id)
            ->when($params['date'], function ($query) use ($startOfDay, $endOfDay) {
                $query->whereBetween('start_date', [$startOfDay, $endOfDay]);
            })
            ->when($params['type'] === "block", function ($query) use ($params) {
                $query->whereHas('block');
            })
            ->when($params['type'] === "goal", function ($query) use ($params) {
                $query->whereHas('goal');
            })
            ->when($params['type'] === "habit", function ($query) use ($params) {
                $query->whereHas('habit');
            })->orderBy('urgent', 'desc');
        return $taskQuery->get();
    }

    public function recursiveDelete($tasks): void
    {
        if ($tasks->count() === 0) return;

        foreach ($tasks as $task) {
            $task->delete();
            if (!$task->completed) {
                $task->forceDelete();
            } else {
                $task->delete();
            }
        }
    }

    public function getHistory($params, $user_id)
    {
        $query = Task::query()
            ->where('user_id', $user_id)
            ->where('completed', true)
            ->when($params['date'] ?? false, function ($query) use ($params) {
                $startOfMonth = Carbon::parse($params['date'])->startOfMonth();
                $endOfMonth = Carbon::parse($params['date'])->endOfMonth();

                $query->whereBetween('start_date', [$startOfMonth, $endOfMonth]);
            })
            ->orderBy('urgent', 'desc')
            ->orderBy('start_date');


        return $query->paginate($params['page'] ?? null);
    }

    public function getOverview($params, $user_id)
    {
        $query = Task::query()
            ->where('user_id', $user_id)
            ->when($params['date'] ?? false, function ($query) use ($params) {
                $startOfMonth = Carbon::parse($params['date'])->startOfMonth();
                $endOfMonth = Carbon::parse($params['date'])->endOfMonth();

                $query->whereBetween('start_date', [$startOfMonth, $endOfMonth]);
            })
            ->orderBy('urgent', 'desc')
            ->orderBy('start_date');

        return $query->paginate($params['page'] ?? null);
    }

    public function getMissedTasks($params, $user_id)
    {
        $page = $params['page'] ?? 15;

        $tasksQuery = Task::query()
            ->where('user_id', $user_id)
            ->where('start_date', '<', now())
            ->when($params['date'] ?? false, function ($query) use ($params) {
                $startDate = Carbon::parse($params['date'])->startOfMonth();
                $endDate = Carbon::parse($params['date'])->endOfMonth();
                if (isset($params['today']) && $params['today']) {
                    $startDate = Carbon::parse($params['date'])->startOfDay();
                    $endDate = Carbon::parse($params['date'])->endOfDay();
                }

                $query->whereBetween('start_date', [$startDate, $endDate]);
            })
            ->where('completed', false)
            ->orderBy('start_date');

        if (isset($params['today']) && $params['today']) {
            return $tasksQuery->get();
        }
         return $tasksQuery->paginate($page);
    }
}
