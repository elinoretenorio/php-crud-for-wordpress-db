<?php

declare(strict_types=1);

namespace WordPress\WpUsermeta;

interface IWpUsermetaService
{
    public function insert(WpUsermetaModel $model): int;

    public function update(WpUsermetaModel $model): int;

    public function get(int $umetaId): ?WpUsermetaModel;

    public function getAll(): array;

    public function delete(int $umetaId): int;

    public function createModel(array $row): ?WpUsermetaModel;
}