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
        $type = $data['type'];
        unset($data['type']);
        $res = [];
        switch ($type) {
            case 'all':
                $res = $this->updateAll($data, $id);
                break;
            case 'this':
                $res = $this->updateThis($data, $id);
                break;
            case 'following':
                $res = $this->updateFollowing($data, $id);
                break;
        }
        return $res;
    }


    /**
     * @throws ValidationException
     */
    public function delete($id, $data): bool
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
            return  $block->delete();
        } elseif (isset($data['type']) && $data['type'] === 'this') {
            if (Carbon::parse($block->start_date) > Carbon::parse($data['date'])) {
                throw ValidationException::withMessages(['message' => 'Cannot delete this event']);
            }
            $tasks = Task::query()->where('block_id', $id)->get();
            $blockData = Arr::except($block->toArray(), ['id', 'created_at', 'updated_at']);
            $formatedDates = $this->getBlockDates($block, $data['date']);
            $prevBlockData = $blockData;
            $nextBlockData = $blockData;
            if ($blockData['end_on']){
                $prevBlockData['end_on'] = $formatedDates['prev_date'];
                $nextBlockData['start_date'] = $formatedDates['next_date'];
            }elseif ($blockData['end_after']){
                $prevBlockData['end_after'] = $data['end_after'];
                $nextBlockData['start_date'] = $formatedDates['next_date'];
            }else{
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
                return $block->delete();
            }
            if ($blockData['end_on']) {
                $newBlockData['end_on'] = $formatedDates['prev_date'];
            }elseif ($blockData['end_after']){
                $newBlockData['end_after'] = $data['end_after'];
            }else{
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

    public function find($id, $user_id): Model|Collection|Builder|array|null
    {
        return Block::query()->where('user_id', $user_id)->find($id);
    }

    private function updateAll($data, $id): Builder|array|Collection|Model
    {

        $block = Block::query()->find($id);
        $blockInfo = BlockInfo::query()->where('block_id', $id)->first();
        $blockInfoData = [];
        if (isset($data['title'])) {
            $blockInfoData['title'] = $data['title'];
        }
        if (isset($data['details'])) {
            $blockInfoData['details'] = $data['details'];
        }
        unset($data['title']);
        unset($data['details']);
        if (!empty($blockInfoData)) {
            $blockInfo->update($blockInfoData);
        }
        if (!empty($data)) {
            $block->update($data);
        }
        return $block;
    }

    private function updateThis($data, $id):  Builder|array|Collection|Model
    {
        $title = $data['title'] ?? null;
        $details = $data['details'] ?? null;
        unset($data['title']);
        unset($data['details']);
        $block = Block::query()->find($id);

        $newBlock = $block->replicate();

        foreach ($data as $key => $value) {
            $newBlock->$key = $value;
        }
        $newBlock->save();
        return $newBlock;

    }

    private function updateFollowing($data, $id): Builder|array|Collection|Model
    {

        $block = Block::query()->find($id);
        $newBlock = $this->create([
            'user_id' => $block->user_id,
            'repeat_every' => $data['repeat_every'] ?? $block->repeat_every,
            'repeat_type' => $data['repeat_type'] ?? $block->repeat_type,
            'repeat_on' => $data['repeat_on'] ?? $block->repeat_on,
            'day_of_week' => $data['day_of_week'],
            'day_of_month' => $data['day_of_month'],
            'month_of_year' => $data['month_of_year'],
            'start_date' => $data['date'],
            'from_time' => $data['from_time'] ?? $block->from_time,
            'to_time' => $data['to_time'] ?? $block->to_time,
            'end_date' => $data['end_date'] ?? $block->end_date,
            'exclude_dates' => $data['exclude_dates'] ?? $block->exclude_dates,
            'end_on' => $data['end_on'] ?? $block->end_on,
            'end_after' => $data['end_after'] ?? $block->end_after,
            'color' => $data['color'] ?? $block->color,

        ]);
        return $newBlock;


    }

    private function getBlockDates($block, $date): array
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


}
