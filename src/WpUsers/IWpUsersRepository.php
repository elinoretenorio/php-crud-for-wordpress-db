<?php

declare(strict_types=1);

namespace WordPress\WpUsers;

interface IWpUsersRepository
{
    public function insert(WpUsersDto $dto): int;

    public function update(WpUsersDto $dto): int;

    public function get(int $id): ?WpUsersDto;

    public function getAll(): array;

    public function delete(int $id): int;
}