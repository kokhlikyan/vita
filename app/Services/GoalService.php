<?php

namespace App\Services;

use App\Repositories\Interfaces\GoalRepositoryInterface;

 class GoalService
{
    public function __construct(private readonly GoalRepositoryInterface $goalRepository)
    {
    }

    public function all()
    {
        return $this->goalRepository->all();
    }

    public function find(int $id)
    {
        return $this->goalRepository->find($id);
    }

    public function create(array $data)
    {
        $newGoal = $this->goalRepository->create($data);
        return $this->find($newGoal->id);
    }

    public function update(array $data, int $id): bool
    {
        $goal = $this->goalRepository->findOwn($id, auth()->id());
        if (!$goal) {
            return false;
        }
        return $this->goalRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        $goal = $this->find($id);
        if (!$goal) {
            return false;
        }
        return $this->goalRepository->delete($id);
    }

}
