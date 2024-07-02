<?php

namespace App\Services;

use App\DTO\RecurrenceDTO;
use App\DTO\TaskDTO;
use App\Models\Task;
use App\Repositories\Interfaces\RecurrenceRepositoryInterface;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    public function __construct(
        private TaskRepositoryInterface       $taskRepository,
        private RecurrenceRepositoryInterface $recurrenceRepository
    )
    {
    }

    public function all(string $search)
    {
        return $this->taskRepository->all(auth()->id(), $search);
    }

    public function findById($id)
    {
        return $this->taskRepository->find($id, auth()->id());
    }

    public function create(array $data)
    {
        $user = auth()->user();
        $taskDTO = new TaskDTO(
            title: $data['title'],
            user_id: $user->id,
            details: $data['details'] ?? '',
            block_id: $data['block_id'] ?? null,
            goal_id: $data['goal_id'] ?? null,
            habit_id: $data['habit_id'] ?? null,
            completed: $data['completed'] ?? false,
            all_day: $data['all_day'] ?? false,
            start_date: $data['start_date'] ?? now()

        );
        $newTask = $this->taskRepository->create($taskDTO->toArray());
        if (isset($data['recurrence_type'])) {
            $end_date = $data['end_date'] ?? Carbon::now()->addDays(90);
            $interval = $this->countTaskRepeatInterval(
                $data['recurrence_type'],
                Carbon::parse(now()),
                Carbon::parse($end_date),
            ) ?? 0;
            $recurrenceDTO = new RecurrenceDTO(
                task_id: $newTask->id,
                recurrence_type: $data['recurrence_type'],
                interval: $interval,
                end_date: $end_date,
                day_of_week: Carbon::parse(now())->dayOfWeek,
                day_of_month: Carbon::parse(now())->day,
                month_of_year: Carbon::parse(now())->month,
            );
            $this->recurrenceRepository->create($recurrenceDTO->toArray());
        }
        return $this->findById($newTask->id);
    }

    public function delete($id): bool
    {
        $task = $this->taskRepository->find($id, auth()->id());
        if (!$task) {
            return false;
        }
        return $task->taskRepository->delete($id);
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

    private function countTaskRepeatInterval($type, $startDate, $endDate): int
    {
        $count = 0;
        if ($type === 'daily') {
            return $startDate->diffInDays($endDate);
        } elseif ($type === 'weekly') {
            return $startDate->diffInWeeks($endDate);
        }elseif ($type === 'monthly') {
            return $startDate->diffInMonths($endDate);
        }
        return $count;
    }

    public function makeCompleted($id): bool
    {
        return $this->taskRepository->makeCompleted($id, auth()->user()->id);
    }

    public function list($params)
    {
        $sortDayCount = (int)($params['sort'] ?? 1);
        return $this->taskRepository->list($sortDayCount, auth()->id());
//        $data = [];
//        foreach ($tasks as $task) {
//            $data[] = $this->generateRecurringTasks($task, Carbon::parse($task->start_date), Carbon::parse($task->end_date));
//        }
//        return $tasks;
    }


//    public function generateRecurringTasks(Task $task, Carbon $startDate, Carbon $endDate)
//    {
//        $tasks = [];
//        $currentDate = $startDate->copy();
//        if ($task->recurrence_type == 'daily') {
//            while ($currentDate->lessThanOrEqualTo($endDate)) {
//                $tasks[] = [
//                    'title' => $task->title,
//                    'details' => $task->details,
//                    'start_time' => $currentDate->copy()->toDateTimeString(),
//                    'end_time' => $currentDate->copy()->toDateTimeString()
//                ];
//                $currentDate->addDays($task->interval);
//            }
//        } elseif ($task->recurrence_type == 'weekly') {
//            for ($i = 1; $i <= $task->interval; $i++){
//                $tasks[] = [
//                    'title' => $task->title,
//                    'details' => $task->details,
//                    'interval_id' => $i, // 'interval_id' => 'week 1', 'week 2', 'week 3', 'week 4
//                    'start_time' => $currentDate->copy()->addWeeks($i)->toDateTimeString(),
//                    'end_time' => $currentDate->copy()->toDateTimeString()
//                ];
//            }
//        } elseif ($task->recurrence_type == 'monthly') {
//            while ($currentDate->lessThanOrEqualTo($endDate)) {
//                if ($currentDate->day == $task->day_of_month) {
//                    $tasks[] = [
//                        'title' => $task->title,
//                        'details' => $task->details,
//                        'start_time' => $currentDate->copy()->toDateTimeString(),
//                        'end_time' => $currentDate->copy()->toDateTimeString()
//                    ];
//                    $currentDate->addMonths($task->interval);
//                } else {
//                    $currentDate->addDay();
//                }
//            }
//        }
//
//        return $tasks;
//    }


}
