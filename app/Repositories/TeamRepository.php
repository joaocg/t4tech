<?php

namespace App\Repositories;

use App\Models\Team;
use App\Repositories\Contracts\TeamRepositoryInterface;

class TeamRepository implements TeamRepositoryInterface
{
    protected $model;

    public function __construct(Team $team)
    {
        $this->model = $team;
    }

    public function all(): mixed
    {
        return $this->model->all();
    }

    public function find(int $id): mixed
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $team = $this->model->findOrFail($id);
        $team->update($data);
        return $team;
    }

    public function delete($id): bool
    {
        $team = $this->model->findOrFail($id);
        return $team->delete();
    }
}
