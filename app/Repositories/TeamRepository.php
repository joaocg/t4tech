<?php

namespace App\Repositories;

use App\Models\Team;
use App\Repositories\Contracts\TeamRepositoryInterface;

class TeamRepository implements TeamRepositoryInterface
{
    protected $model;

    public function __construct(?Team $team)
    {
        $this->model = $team;
    }

    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->model->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    /**
     * @param mixed $checking
     * @param array $data
     * @return mixed
     */
    public function updateOrCreate(mixed $checking, array $data): mixed
    {
        return Team::updateOrCreate($checking, $data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data): mixed
    {
        $team = $this->model->findOrFail($id);
        $team->update($data);
        return $team;
    }


    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $team = $this->model->findOrFail($id);
        return $team->delete();
    }
}
