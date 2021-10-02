<?php

declare(strict_types=1);

namespace WordPress\WpPosts;

interface IWpPostsRepository
{
    public function insert(WpPostsDto $dto): int;

    public function update(WpPostsDto $dto): int;

    public function get(int $id): ?WpPostsDto;

    public function getAll(): array;

    public function delete(int $id): int;
}