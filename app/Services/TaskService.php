<?php

namespace App\Services;

use App\DTO\TaskDTO;
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
        $tasks = $this->generateTaskList($data, $user->id);
        $newTasks = [];
        foreach ($tasks as $task) {
            $newTasks[] = $this->taskRepository->create($task->toArray());
        }

        return $newTasks;
    }

    private function generateTaskList(array $data, $userID): array
    {
        $tasks = [];
        $uuid = Str::uuid();
        if (!isset($data['recurrence_type'])) {
            $tasks[] = new TaskDTO(
                uuid: $uuid,
                title: $data['title'],
                user_id: $userID,
                details: $data['details'] ?? '',
                block_id: $data['block_id'] ?? null,
                goal_id: $data['goal_id'] ?? null,
                habit_id: $data['habit_id'] ?? null,
                completed: $data['completed'] ?? false,
                all_day: $data['all_day'] ?? false,
                start_date: $data['start_date'] ?? now()

            );
        } else {
            $currentDate = Carbon::parse($data['start_date'] ?? Carbon::now()->addMonth(3));
            $endDate = $data['end_date'] ?? Carbon::now()->addDays(90);

            while ($currentDate->lessThanOrEqualTo($endDate)) {
                $tasks[] = new TaskDTO(
                    uuid: $uuid,
                    title: $data['title'],
                    user_id: $userID,
                    details: $data['details'] ?? '',
                    block_id: $data['block_id'] ?? null,
                    goal_id: $data['goal_id'] ?? null,
                    habit_id: $data['habit_id'] ?? null,
                    completed: $data['completed'] ?? false,
                    all_day: $data['all_day'] ?? false,
                    start_date: $currentDate->toDateTimeString()

                );
                if ($data['recurrence_type'] === 'daily') {
                    $currentDate->addDay();
                } elseif ($data['recurrence_type'] === 'weekly') {
                    $currentDate->addWeek();
                } elseif ($data['recurrence_type'] === 'monthly') {
                    if ($currentDate->day == $data['day_of_month']) {
                        $currentDate->addMonth();
                    } else {
                        $currentDate->addDay();
                    }
                }
            }
        }

        return $tasks;
    }

    public function delete($id): bool
    {
        $task = $this->taskRepository->find($id, auth()->id());
        if (!$task) {
            return false;
        }
        return $this->taskRepository->delete($id);
    }

    public function update(array $data, $id)
    {
        $task = $this->taskRepository->find($id, auth()->id());
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

    public function list($params)
    {
        $sortDayCount = (int)($params['sort'] ?? 1);
        $date = Carbon::parse($params['date'] ?? now());
        return $this->taskRepository->list($sortDayCount, $date, auth()->id());
    }


}
