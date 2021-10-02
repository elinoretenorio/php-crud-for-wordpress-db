<?php

declare(strict_types=1);

namespace WordPress\WpPosts;

interface IWpPostsService
{
    public function insert(WpPostsModel $model): int;

    public function update(WpPostsModel $model): int;

    public function get(int $id): ?WpPostsModel;

    public function getAll(): array;

    public function delete(int $id): int;

    public function createModel(array $row): ?WpPostsModel;
}