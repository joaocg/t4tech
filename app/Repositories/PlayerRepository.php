<?php

namespace App\Repositories;

use App\Models\Player;
use App\Repositories\Contracts\PlayerRepositoryInterface;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function all()
    {
        return Player::all();
    }

    public function find($id)
    {
        return Player::findOrFail($id);
    }

    public function create(array $data)
    {
        return Player::create($data);
    }

    public function update($id, array $data)
    {
        $player = $this->find($id);
        $player->update($data);
        return $player;
    }

    public function delete($id)
    {
        $player = $this->find($id);
        $player->delete();
        return $player;
    }
}
