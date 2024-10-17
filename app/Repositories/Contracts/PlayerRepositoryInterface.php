<?php

namespace App\Repositories\Contracts;

interface PlayerRepositoryInterface
{
    /**
     * Get all players.
     *
     * @return mixed
     */
    public function all(): mixed;

    /**
     * Find a player by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed;

    /**
     * Create a new player.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;

    /**
     * Create a new player.
     *
     * @param array $data
     * @return mixed
     */
    public function updateOrCreate(mixed $checking, array $data): mixed;

    /**
     * Update a player by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data): mixed;

    /**
     * Delete a player by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
