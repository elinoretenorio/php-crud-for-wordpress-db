<?php

declare(strict_types=1);

namespace WordPress\WpUsers;

interface IWpUsersService
{
    public function insert(WpUsersModel $model): int;

    public function update(WpUsersModel $model): int;

    public function get(int $id): ?WpUsersModel;

    public function getAll(): array;

    public function delete(int $id): int;

    public function createModel(array $row): ?WpUsersModel;
}