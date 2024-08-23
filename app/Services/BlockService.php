<?php

namespace App\Services;

use App\Models\BlockInfo;
use App\Repositories\Interfaces\BlockRepositoryInterface;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

readonly class BlockService
{
    public function __construct(
        private BlockRepositoryInterface $blockRepository,
        private TaskRepositoryInterface $taskRepository
    )
    {
    }

    public function all()
    {
        return $this->blockRepository->all(auth()->id());
    }

    public function find(int $id): Model|Builder|null
    {
        return $this->blockRepository->find($id, auth()->id());
    }

    public function create(array $data)
    {
        $data['day_of_week'] = Carbon::parse($data['start_date'])->dayOfWeek;
        $data['day_of_month'] = Carbon::parse($data['start_date'])->day;
        $data['month_of_year'] = Carbon::parse($data['start_date'])->month;
        $newBlock = $this->blockRepository->create($data);
        BlockInfo::query()->create([
            'block_id' => $newBlock->id,
            'uuid' => $newBlock->uuid,
            'title' => $data['title'],
            'details' => $data['details'] ?? '',
        ]);
        return $this->find($newBlock->id);
    }

    public function delete(int $id, $data): bool
    {
        $block = $this->find($id);
        if (!$block) {
            return false;
        }
        $tasks = $block->tasks;
        if ($tasks->count() > 0) {
            foreach ($tasks as $task) {
                $task->delete();
                if (!$task->completed){
                    $task->forceDelete();
                }else{
                    $task->delete();
                }
            }
        }
        return $this->blockRepository->delete($id, $data);
    }

    public function update(array $data, int $id): bool
    {
        $block = $this->find($id);
        if (!$block) {
            return false;
        }
        return $this->blockRepository->update($data, $id);
    }
}
