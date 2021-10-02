<?php

declare(strict_types=1);

namespace WordPress\WpPostmeta;

interface IWpPostmetaRepository
{
    public function insert(WpPostmetaDto $dto): int;

    public function update(WpPostmetaDto $dto): int;

    public function get(int $metaId): ?WpPostmetaDto;

    public function getAll(): array;

    public function delete(int $metaId): int;
}