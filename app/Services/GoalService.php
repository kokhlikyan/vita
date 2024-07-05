<?php

namespace App\Services;

use App\Repositories\Interfaces\GoalRepositoryInterface;
use App\Repositories\Interfaces\TaskRepositoryInterface;

readonly class GoalService
{
    public function __construct(
        private GoalRepositoryInterface $goalRepository,
        private TaskRepositoryInterface $taskRepository
    )
    {
    }

    public function all()
    {
        return $this->goalRepository->all(auth()->id());
    }

    public function find(int $id)
    {
        return $this->goalRepository->find($id, auth()->id());
    }

    public function create(array $data)
    {
        $newGoal = $this->goalRepository->create($data);
        return $this->find($newGoal->id);
    }

    public function update(array $data, int $id): bool
    {
        $goal = $this->goalRepository->find($id, auth()->id());
        if (!$goal) {
            return false;
        }
        return $this->goalRepository->update($data, $id);
    }

    public function delete(int $id): bool
    {
        $goal = $this->find($id);
        if (!$goal) {
            return false;
        }
        $this->taskRepository->recursiveDelete($goal->tasks);
        return $this->goalRepository->delete($id);
    }

}
