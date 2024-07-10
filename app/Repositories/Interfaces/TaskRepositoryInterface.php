<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
    public function all(int $user_id, string $search, $page);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id, $user_id, $force);

    public function find($id, $user_id);

    public function list($sortDayCount, $date, $user_id);

    public function filteredTasks($params, $user_id);

    public function recursiveDelete($tasks);

    public function getHistory($params, $user_id);
    public function getOverview($params, $user_id);

    public function getMissedTasks($params, $user_id);

}
