<?php

namespace App\Repositories;

use App\Models\Player;
use App\Repositories\Contracts\PlayerRepositoryInterface;

class PlayerRepository implements PlayerRepositoryInterface
{

    protected $model;

    /**
     * @param Player|null $player
     */
    public function __construct(?Player $player)
    {
        $this->model = $player;
    }

    /**
     * @return mixed
     */
    public function all(): mixed
    {
        return Player::all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return Player::findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return Player::create($data);
    }

    /**
     * @param mixed $checking
     * @param array $data
     * @return mixed
     */
    public function updateOrCreate(mixed $checking, array $data): mixed
    {
        return Player::updateOrCreate($checking, $data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data): mixed
    {
        $player = $this->find($id);
        $player->update($data);
        return $player;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $player = $this->find($id);
        return $player->delete();
    }
}
