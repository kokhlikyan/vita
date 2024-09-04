<?php

namespace App\Repositories;

use App\Models\Block;
use App\Models\BlockInfo;
use App\Models\Task;
use App\Repositories\Interfaces\BlockRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class BlockRepository implements BlockRepositoryInterface
{

    public function all(int $user_id): Collection
    {
        return Block::query()
            ->where('blocks.user_id', $user_id)
            ->orderByDesc('created_at')
            ->get();
    }

    public function create(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return Block::query()->create([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'details' => $data['details'] ?? null,
            'repeat_every' => $data['repeat_every'] ?? 1,
            'repeat_type' => $data['repeat_type'] ?? null,
            'repeat_on' => $data['repeat_on'] ?? null,
            'start_date' => $data['start_date'],
            'from_time' => $data['from_time'] ?? null,
            'to_time' => $data['to_time'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'end_on' => $data['end_on'] ?? null,
            'end_after' => $data['end_after'] ?? null,
            'color' => $data['color'] ?? '#4B5459',
        ]);
    }

    public function update(array $data, $id): Builder|array|Collection|Model
    {
        $block = Block::query()->find($id);
        $tasks = Task::query()->where('block_id', $id)->get();

        $type = $data['type'];
        $updatedDate = $data['date'];
        $data = Arr::except($data, ['type', 'date']);
        $formatedDates = $this->getBlockDates($block, $updatedDate);
        switch ($type) {
            case 'all':
                $block->update($data);
                break;
            case 'this':
                $oldBlockData = Arr::except($block->toArray(), ['id', 'created_at', 'updated_at']);
                $prevBlockData = $oldBlockData;
                $nextBlockData = $oldBlockData;
                $prevBlockData['end_on'] = $formatedDates['prev_date'];
                $nextBlockData['start_date'] = $formatedDates['next_date'];
                $prevBlock = Block::query()->create($prevBlockData);
                $nextBlock = Block::query()->create($nextBlockData);
                $newBlock = Block::query()->create([
                    'user_id' => $block->user_id,
                    'title' => $data['title'] ?? $block->title,
                    'details' => $data['details'] ?? $block->details,
                    'repeat_every' => $data['repeat_every'] ?? $block->repeat_every,
                    'repeat_type' => $data['repeat_type'] ?? $block->repeat_type,
                    'repeat_on' => $data['repeat_on'] ?? $block->repeat_on,
                    'start_date' => $updatedDate,
                    'from_time' => $data['from_time'] ?? $block->from_time,
                    'to_time' => $data['to_time'] ?? $block->to_time,
                    'end_date' => $data['end_date'] ?? $block->end_date,
                    'end_on' => !isset($data['repeat_type']) ? Carbon::parse($formatedDates['next_date'])->format('Y-m-d') : $data['end_on'] ?? $block->end_on,
                    'end_after' => $data['end_after'] ?? $block->end_after,
                    'color' => $data['color'] ?? $block->color,
                ]);
                if (count($tasks) > 0) {
                    foreach ($tasks as $task) {
                        $taskData = Arr::except($task->toArray(), ['id', 'created_at', 'updated_at']);
                        $prevBlockTaskData = $taskData;
                        $nextBlockTaskData = $taskData;
                        $newBlockTaskData = $taskData;
                        $prevBlockTaskData['block_id'] = $prevBlock->id;
                        $nextBlockTaskData['block_id'] = $nextBlock->id;
                        $newBlockTaskData['block_id'] = $nextBlock->id;
                        Task::query()->create($prevBlockTaskData);
                        Task::query()->create($nextBlockTaskData);
                        Task::query()->create($newBlockTaskData);
                        $task->delete();
                    }
                }

                $block->delete();
                $block = $newBlock;
                break;
            case 'following':
                $newBlock = Block::query()->create([
                    'user_id' => $block->user_id,
                    'title' => $data['title'] ?? $block->title,
                    'details' => $data['details'] ?? $block->details,
                    'repeat_every' => $data['repeat_every'] ?? $block->repeat_every,
                    'repeat_type' => $data['repeat_type'] ?? $block->repeat_type,
                    'repeat_on' => $data['repeat_on'] ?? $block->repeat_on,
                    'start_date' => $updatedDate,
                    'from_time' => $data['from_time'] ?? $block->from_time,
                    'to_time' => $data['to_time'] ?? $block->to_time,
                    'end_date' => $data['end_date'] ?? $block->end_date,
                    'end_on' => $data['end_on'] ?? $block->end_on,
                    'end_after' => $data['end_after'] ?? $block->end_after,
                    'color' => $data['color'] ?? $block->color,
                ]);
                $block->update([
                    'end_on' => $formatedDates['prev_date'],
                ]);
                foreach ($tasks as $task) {
                    $taskData = Arr::except($task->toArray(), ['id', 'created_at', 'updated_at']);
                    $taskData['block_id'] = $newBlock->id;
                    Task::query()->create($taskData);
                }
                break;

        }

        return $block;
    }


    /**
     * @throws ValidationException
     */
    public
    function delete($id, $data): bool
    {
        $block = Block::query()->find($id);
        if (isset($data['type']) && $data['type'] === 'all') {
            $block = Block::query()->find($id);
            $tasks = Task::query()->where('block_id', $id)->get();
            if ($tasks->count() > 0) {
                foreach ($tasks as $task) {
                    $task->delete();
                }
            }
            return $block->delete();
        } elseif (isset($data['type']) && $data['type'] === 'this') {
            if (Carbon::parse($block->start_date) > Carbon::parse($data['date'])) {
                throw ValidationException::withMessages(['message' => 'Cannot delete this event']);
            }
            $tasks = Task::query()->where('block_id', $id)->get();
            $blockData = Arr::except($block->toArray(), ['id', 'created_at', 'updated_at']);
            $formatedDates = $this->getBlockDates($block, $data['date']);
            $prevBlockData = $blockData;
            $nextBlockData = $blockData;
            if ($blockData['end_on']) {
                $prevBlockData['end_on'] = $formatedDates['prev_date'];
                $nextBlockData['start_date'] = $formatedDates['next_date'];
            } elseif ($blockData['end_after']) {
                $prevBlockData['end_after'] = $data['end_after'];
                $nextBlockData['start_date'] = $formatedDates['next_date'];
            } else {
                $prevBlockData['end_on'] = $formatedDates['prev_date'];
                $nextBlockData['start_date'] = $formatedDates['next_date'];
            }
            $prevBlock = Block::query()->create($prevBlockData);
            $nextBlock = Block::query()->create($nextBlockData);
            foreach ($tasks as $task) {
                $taskData = Arr::except($task->toArray(), ['id', 'created_at', 'updated_at']);
                $prevBlockTaskData = $taskData;
                $nextBlockTaskData = $taskData;
                $prevBlockTaskData['block_id'] = $prevBlock->id;
                $nextBlockTaskData['block_id'] = $nextBlock->id;
                Task::query()->create($prevBlockTaskData);
                Task::query()->create($nextBlockTaskData);
                $task->delete();
            }
            return $block->delete();
        } elseif (isset($data['type']) && $data['type'] === 'following') {
            $tasks = Task::query()->where('block_id', $id)->get();
            $blockData = Arr::except($block->toArray(), ['id', 'created_at', 'updated_at']);
            $formatedDates = $this->getBlockDates($block, $data['date']);
            $newBlockData = $blockData;
            if (Carbon::parse($block->start_date) > Carbon::parse($formatedDates['prev_date'])) {
                foreach ($tasks as $task) {
                    $task->delete();
                }
                return $block->delete();
            }
            if ($blockData['end_on']) {
                $newBlockData['end_on'] = $formatedDates['prev_date'];
            } elseif ($blockData['end_after']) {
                $newBlockData['end_after'] = $data['end_after'];
            } else {
                $newBlockData['end_on'] = $formatedDates['prev_date'];
            }
            $newBlock = Block::query()->create($newBlockData);
            foreach ($tasks as $task) {
                $taskData = Arr::except($task->toArray(), ['id', 'created_at', 'updated_at']);
                $taskData['block_id'] = $newBlock->id;
                Task::query()->create($taskData);
                $task->delete();
            }
            return $block->delete();
        }
        return false;
    }

    public
    function find($id, $user_id): Model|Collection|Builder|array|null
    {
        return Block::query()->where('user_id', $user_id)->find($id);
    }

    private
    function getBlockDates($block, $date): array
    {
        $result = [
            'prev_date' => null,
            'next_date' => null,
        ];
        switch ($block->repeat_type) {
            case 'day':
                $result['prev_date'] = Carbon::parse($date)->subDays(1 * $block->repeat_every);
                $result['next_date'] = Carbon::parse($date)->addDays(1 * $block->repeat_every);
                break;
            case 'week':
                $result['prev_date'] = Carbon::parse($date)->subWeeks(1 * $block->repeat_every);
                $result['next_date'] = Carbon::parse($date)->addWeeks(1 * $block->repeat_every);
                break;
            case 'month':
                $result['prev_date'] = Carbon::parse($date)->subMonths(1 * $block->repeat_every);
                $result['next_date'] = Carbon::parse($date)->addMonths(1 * $block->repeat_every);
                break;
            case 'year':
                $result['prev_date'] = Carbon::parse($date)->subYears(1 * $block->repeat_every);
                $result['next_date'] = Carbon::parse($date)->addYears(1 * $block->repeat_every);
                break;
        }

        return $result;

    }

    public function filteredByDate(int $user_id, string $date, int $sort): Collection|array
    {
        $results = [];
        $startOfDay = Carbon::parse($date);
        $blocks = Block::query()
            ->where('user_id', $user_id)
            ->where('start_date', '<=', $date)
            ->where(function ($query) use ($startOfDay) {
                $query->where('end_on', '>=', $startOfDay)
                    ->orWhere('end_on', null);
            })
            ->get();

        foreach ($blocks as $block) {
            $convertedDate = Carbon::parse($date);
            while ($convertedDate->format('Y-m-d') < Carbon::parse($date)->addDays($sort)->format('Y-m-d')) {
                $blockClone = clone $block;
                if ($block->repeat_type === 'day') {
                    $day = Carbon::parse($block->start_date);
                    $loopEnd = Carbon::parse($date)->addDays($sort);
                    if ($block->end_after) $loopEnd = Carbon::parse($block->start_date)->addDays($block->end_after);
                    if ($block->end_on) $loopEnd = Carbon::parse($block->end_on);
                    while ($day->format('Y-m-d') <= $loopEnd->format('Y-m-d')) {
                        if ($day->format('Y-m-d') >= Carbon::parse($date)->format('Y-m-d') &&
                            $day->format('Y-m-d') < Carbon::parse($date)->addDays($sort)->format('Y-m-d')) {
                            $blockClone = clone $block;
                            $blockClone->start_date = $day->format('Y-m-d');
                            $blockClone->end_date = $day->format('Y-m-d');
                            $results[] = $blockClone;
                        }
                        $day = $day->addDays($block->repeat_every);
                    }
                } elseif ($block->repeat_type === 'week') {
                    foreach ($block->repeat_on as $day) {
                        $dayOfWeek = $convertedDate->copy()->startOfWeek()->addDays((int)$day);
                        if (
                            ($dayOfWeek->format('Y-m-d') >= Carbon::parse($date)->format('Y-m-d') &&
                                $dayOfWeek->format('Y-m-d') <= Carbon::parse($date)->addDays($sort)->format('Y-m-d')) ||
                            $dayOfWeek->format('Y-m-d') === Carbon::parse($date)->format('Y-m-d')) {
                            $blockClone = clone $block;
                            $blockClone->start_date = $dayOfWeek->format('Y-m-d');
                            $blockClone->end_date = $dayOfWeek->format('Y-m-d');
                            $results[] = $blockClone;
                        }
                    }
                } elseif ($block->repeat_type === 'month') {
                    $dayOfMonth = $convertedDate->copy()->startOfMonth()->addDays(Carbon::parse($block->start_date)->day - 1);
                    if (
                        $dayOfMonth->format('Y-m-d') === Carbon::parse($date)->format('Y-m-d') ||
                        (
                            $dayOfMonth->format('Y-m-d') >= Carbon::parse($date)->format('Y-m-d') &&
                            $dayOfMonth->format('Y-m-d') <= Carbon::parse($date)->addDays($sort)->format('Y-m-d')
                        )
                    ) {
                        $blockClone = clone $block;
                        $blockClone->start_date = $dayOfMonth->format('Y-m-d');
                        $blockClone->end_date = $dayOfMonth->format('Y-m-d');
                        $results[] = $blockClone;
                    }
                } elseif ($block->repeat_type === 'year') {
                    $dayOfYear = $convertedDate->copy()->startOfYear()->addDays(Carbon::parse($block->start_date)->dayOfYear - 1);
                    if (
                        $dayOfYear->format('Y-m-d') === Carbon::parse($date)->format('Y-m-d') ||
                        (
                            $dayOfYear->format('Y-m-d') >= Carbon::parse($date)->format('Y-m-d') &&
                            $dayOfYear->format('Y-m-d') <= Carbon::parse($date)->addDays($sort)->format('Y-m-d')
                        )
                    ) {
                        $blockClone = clone $block;
                        $blockClone->start_date = $dayOfYear->format('Y-m-d');
                        $blockClone->end_date = $dayOfYear->format('Y-m-d');
                        $results[] = $blockClone;
                    }
                }
                break;
            }

        }
        return $results;
    }
}
