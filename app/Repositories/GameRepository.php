<?php

namespace App\Repositories;

use App\Models\Game;
use App\Repositories\Contracts\GameRepositoryInterface;

class GameRepository implements GameRepositoryInterface
{
    protected $model;

    /**
     * @param Game|null $game
     */
    public function __construct(?Game $game)
    {
        $this->model = $game;
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
        return Game::updateOrCreate($checking, $data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data): mixed
    {
        $game = $this->model->findOrFail($id);
        $game->update($data);
        return $game;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $game = $this->model->findOrFail($id);
        return $game->delete();
    }
}
