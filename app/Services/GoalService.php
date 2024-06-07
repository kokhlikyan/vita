<?php

namespace App\Services;

use App\Repositories\Interfaces\GoalRepositoryInterface;

 class GoalService
{
    public function __construct(private GoalRepositoryInterface $goalRepository)
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

}
