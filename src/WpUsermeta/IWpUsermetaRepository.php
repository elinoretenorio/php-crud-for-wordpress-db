<?php

declare(strict_types=1);

namespace WordPress\WpUsermeta;

interface IWpUsermetaRepository
{
    public function insert(WpUsermetaDto $dto): int;

    public function update(WpUsermetaDto $dto): int;

    public function get(int $umetaId): ?WpUsermetaDto;

    public function getAll(): array;

    public function delete(int $umetaId): int;
}