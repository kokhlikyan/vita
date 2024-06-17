<?php

namespace App\Services;

use App\Repositories\Interfaces\HabitRepositoryInterface;

readonly class HabitService
{
    public function __construct(private HabitRepositoryInterface $habitRepository)
    {
    }

    public function all()
    {
        return $this->habitRepository->all(auth()->id());
    }

    public function findById($id)
    {
        return $this->habitRepository->find($id, auth()->id());
    }

    public function create(array $data)
    {
        return $this->habitRepository->create($data);
    }

    public function update(array $data, $id): bool
    {
        $habit = $this->habitRepository->find($id, auth()->id());
        if (!$habit) {
            return false;
        }
        return $this->habitRepository->update($data, $id);
    }

    public function delete($id): bool
    {
        $habit = $this->habitRepository->find($id, auth()->id());
        if (!$habit) {
            return false;
        }
        return $this->habitRepository->delete($id);
    }

}
