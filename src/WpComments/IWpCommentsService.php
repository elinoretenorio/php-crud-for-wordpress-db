<?php

declare(strict_types=1);

namespace WordPress\WpComments;

interface IWpCommentsService
{
    public function insert(WpCommentsModel $model): int;

    public function update(WpCommentsModel $model): int;

    public function get(int $commentId): ?WpCommentsModel;

    public function getAll(): array;

    public function delete(int $commentId): int;

    public function createModel(array $row): ?WpCommentsModel;
}