<?php

declare(strict_types=1);

namespace WordPress\WpTermRelationships;

interface IWpTermRelationshipsRepository
{
    public function insert(WpTermRelationshipsDto $dto): int;

    public function update(WpTermRelationshipsDto $dto): int;

    public function get(int $objectId): ?WpTermRelationshipsDto;

    public function getAll(): array;

    public function delete(int $objectId): int;
}