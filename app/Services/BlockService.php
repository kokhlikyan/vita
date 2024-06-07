<?php

namespace App\Services;

use App\Repositories\Interfaces\BlockRepositoryInterface;

class BlockService
{
    public function __construct(private BlockRepositoryInterface $blockRepository)
    {
    }

    public function all()
    {
        return $this->blockRepository->all();
    }

    public function find(int $id)
    {
        return $this->blockRepository->find($id);
    }

    public function create(array $data)
    {
        $newBlock = $this->blockRepository->create($data);
        return $this->find($newBlock->id);
    }

    public function findOwn($id)
    {
        return $this->blockRepository->findOwn($id, auth()->id());
    }
}
