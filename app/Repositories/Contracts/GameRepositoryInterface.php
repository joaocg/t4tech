<?php

namespace App\Repositories\Contracts;

interface GameRepositoryInterface
{
    /**
     * Get all games.
     *
     * @return mixed
     */
    public function all(): mixed;

    /**
     * Find a game by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed;

    /**
     * Create a new game.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;

    /**
     * Update a game by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data): mixed;

    /**
     * Delete a game by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
