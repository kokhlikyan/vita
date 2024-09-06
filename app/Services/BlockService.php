<?php

namespace App\Services;

use App\Models\BlockInfo;
use App\Repositories\Interfaces\BlockRepositoryInterface;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
        $newBlock = $this->blockRepository->create($data);
        return $this->find($newBlock->id);
    }

    public function delete(int $id, $data): bool
    {
        $block = $this->find($id);
        if (!$block) {
            return false;
        }
        return $this->blockRepository->delete($id, $data);
    }

    public function update(array $data, int $id): Builder|array|Collection|Model
    {
        return $this->blockRepository->update($data, $id);
    }

    public function filteredByDate(string $date, int $sort, string $type): Collection|Builder|array
    {
        $user = auth()->user();
        return $this->blockRepository->filteredByDate($user->id, $date, $sort, $type);
    }
}
