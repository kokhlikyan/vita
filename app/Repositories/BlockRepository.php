<?php

namespace App\Repositories;

use App\Models\Block;
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

    public function update(array $data, $id): bool
    {
        return Block::query()->find($id)->update($data);
    }

    /**
     * @throws ValidationException
     */
    public function delete($id, $data): bool
    {
        $block = Block::query()->find($id);
        if (isset($data['type']) && $data['type'] === 'all') {
            return Block::destroy($id);
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

}
