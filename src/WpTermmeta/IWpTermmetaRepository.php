<?php

declare(strict_types=1);

namespace WordPress\WpTermmeta;

interface IWpTermmetaRepository
{
    public function insert(WpTermmetaDto $dto): int;

    public function update(WpTermmetaDto $dto): int;

    public function get(int $metaId): ?WpTermmetaDto;

    public function getAll(): array;

    public function delete(int $metaId): int;
}