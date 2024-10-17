<?php

namespace App\Repositories;

use App\Models\Game;
use App\Repositories\Contracts\GameRepositoryInterface;

class GameRepository implements GameRepositoryInterface
{
    protected $model;

    public function __construct(Game $game)
    {
        $this->model = $game;
    }

    public function all(): mixed
    {
        return $this->model->all();
    }

    public function find($id): mixed
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    public function update($id, array $data): mixed
    {
        $game = $this->model->findOrFail($id);
        $game->update($data);
        return $game;
    }

    public function delete($id): bool
    {
        $game = $this->model->findOrFail($id);
        return $game->delete();
    }
}
