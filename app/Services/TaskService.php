<?php

namespace App\Services;

use App\DTO\TaskDTO;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class TaskService
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository,

    )
    {
    }

    public function all(string $search, $page)
    {
        return $this->taskRepository->all(auth()->id(), $search, $page);
    }

    public function findById($id)
    {
        return $this->taskRepository->find($id, auth()->id());
    }

    public function create(array $data)
    {
        $user = auth()->user();
        $start_date = null;
        $end_date = null;
        if (isset($data['start_date'])){
            $start_date = Carbon::parse($data['start_date']);
            $end_date = Carbon::parse($data['start_date'])->addHour();
        }
        $task = new TaskDTO(
                    title: $data['title'],
                    user_id: $user->id,
                    details: $data['details'] ?? '',
                    block_id: $data['block_id'] ?? null,
                    goal_id: $data['goal_id'] ?? null,
                    habit_id: $data['habit_id'] ?? null,
                    completed: $data['completed'] ?? false,
                    urgent: $data['urgent'] ?? false,
                    start_date: $start_date,
                    end_date: $end_date
                );


        return $this->taskRepository->create($task->toArray());
    }


    public function delete($id): bool
    {
        return $this->taskRepository->delete($id, auth()->id());
    }

    public function update(array $data, $id)
    {
        $task = $this->taskRepository->find($id, auth()->id());
        if (isset($data['start_date'])){
            $data['end_date'] = Carbon::parse($data['start_date'])->addHour();
        }
        if (!$task) {
            return false;
        }
        return $this->taskRepository->update($data, $id);
    }

    public function findAllWithBlock(): Collection|array
    {
        return $this->taskRepository->findAllWithBlock(auth()->user()->id);
    }

    public function makeCompleted($id): bool
    {
        return $this->taskRepository->makeCompleted($id, auth()->user()->id);
    }

    public function makeUrgent($id): bool
    {
        return $this->taskRepository->makeUrgent($id, auth()->user()->id);
    }

    public function list($params)
    {
        $sortDayCount = (int)($params['sort'] ?? 1);
        $date = Carbon::parse($params['date'] ?? now());
        $type = $params['type'] ?? 'all';
        return $this->taskRepository->list($sortDayCount, $date, $type, auth()->id());
    }

    public function filteredTasks($params)
    {
        return $this->taskRepository->filteredTasks($params, auth()->id());
    }

    public function getHistory($params)
    {
        return $this->taskRepository->getHistory($params, auth()->id());
    }

    public function getOverview($params)
    {
        return $this->taskRepository->getOverview($params, auth()->id());
    }

}
