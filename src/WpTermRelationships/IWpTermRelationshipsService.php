<?php

declare(strict_types=1);

namespace WordPress\WpTermRelationships;

interface IWpTermRelationshipsService
{
    public function insert(WpTermRelationshipsModel $model): int;

    public function update(WpTermRelationshipsModel $model): int;

    public function get(int $objectId): ?WpTermRelationshipsModel;

    public function getAll(): array;

    public function delete(int $objectId): int;

    public function createModel(array $row): ?WpTermRelationshipsModel;
}