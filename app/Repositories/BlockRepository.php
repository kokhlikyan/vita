<?php

namespace App\Repositories;

use App\Models\Block;
use App\Models\BlockInfo;
use App\Repositories\Interfaces\BlockRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
            'uuid' => $data['uuid'],
            'repeat_every' => $data['repeat_every'] ?? null,
            'repeat_type' => $data['repeat_type'] ?? null,
            'repeat_on' => $data['repeat_on'] ?? null,
            'day_of_week' => $data['day_of_week'],
            'day_of_month' => $data['day_of_month'],
            'month_of_year' => $data['month_of_year'],
            'start_date' => $data['start_date'],
            'from_time' => $data['from_time'] ?? null,
            'to_time' => $data['to_time'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'exclude_dates' => $data['exclude_dates'] ?? [],
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
            $allBlocks = Block::query()->where('uuid', $block->uuid)->get();
            foreach ($allBlocks as $block) {
                $block->delete();
            }
            return true;
        } elseif (isset($data['type']) && $data['type'] === 'this') {
            if (Carbon::parse($block->start_date) > Carbon::parse($data['date'])) {
                throw ValidationException::withMessages(['message' => 'Cannot delete this event']);
            }
            if (in_array($data['date'], $block->exclude_dates)) {
                return false;
            }
            $block->exclude_dates = array_merge($block->exclude_dates, [$data['date']]);
            return $block->save();
        } elseif (isset($data['type']) && $data['type'] === 'following') {
            if (isset($data['end_date'])) {
                $block->end_after = null;
                $block->end_on = $data['end_date'];
                return $block->save();
            }
            if (isset($data['end_after'])) {
                $block->end_on = null;
                $block->end_after = $data['end_after'];
                return $block->save();
            }
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
        BlockInfo::query()->create([
            'uuid' => $block->uuid,
            'block_id' => $newBlock->id,
            'title' => $title ?? $block->blockInfo->title,
            'details' => $details ?? $block->blockInfo->details,
        ]);
        return $newBlock;

    }

    private function updateFollowing($data, $id): Builder|array|Collection|Model
    {

        $data['day_of_week'] = Carbon::parse($data['date'])->dayOfWeek;
        $data['day_of_month'] = Carbon::parse($data['date'])->day;
        $data['month_of_year'] = Carbon::parse($data['date'])->month;
        $block = Block::query()->find($id);
        $newBlock = $this->create([
            'user_id' => $block->user_id,
            'uuid' => $block->uuid,
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
        BlockInfo::query()->create([
            'uuid' => $block->uuid,
            'block_id' => $newBlock->id,
            'title' => $data['title'] ?? $block->blockInfo->title,
            'details' => $data['details'] ?? $block->blockInfo->details,
        ]);
        return $newBlock;


    }

}
