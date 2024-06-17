<?php

namespace App\Repositories;

use App\Models\Recurrence;
use App\Repositories\Interfaces\RecurrenceRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RecurrenceRepository implements RecurrenceRepositoryInterface
{
    public function all()
    {

    }

    public function create(array $data): Model|Builder
    {
        return Recurrence::query()->create($data);
    }

    public function update(array $data, $id)
    {

    }

    public function delete($id)
    {

    }

    public function find($id)
    {

    }

    public function findOwn($id, $user_id)
    {

    }

}
