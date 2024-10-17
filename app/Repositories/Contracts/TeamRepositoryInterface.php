<?php

namespace App\Repositories\Contracts;

interface TeamRepositoryInterface
{
    /**
     * Get all teams.
     *
     * @return mixed
     */
    public function all(): mixed;

    /**
     * Find a team by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed;

    /**
     * Create a new team.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;

    /**
     * Update a team by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data): mixed;

    /**
     * Delete a team by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
