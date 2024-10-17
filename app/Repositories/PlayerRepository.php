<?php

namespace App\Repositories;

use App\Models\Player;
use App\Repositories\Contracts\PlayerRepositoryInterface;

class PlayerRepository implements PlayerRepositoryInterface
{

    protected $model;

    public function __construct(?Player $player)
    {
        $this->model = $player;
    }

    public function all(): mixed
    {
        return Player::all();
    }

    public function find($id): mixed
    {
        return Player::findOrFail($id);
    }

    public function create(array $data): mixed
    {
        return Player::create($data);
    }

    public function updateOrCreate(mixed $checking, array $data): mixed
    {
        return Player::updateOrCreate($checking, $data);
    }

    public function update($id, array $data): mixed
    {
        $player = $this->find($id);
        $player->update($data);
        return $player;
    }

    public function delete($id): bool
    {
        $player = $this->find($id);
        return $player->delete();
    }
}
