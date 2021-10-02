<?php

declare(strict_types=1);

namespace WordPress\WpTermmeta;

interface IWpTermmetaService
{
    public function insert(WpTermmetaModel $model): int;

    public function update(WpTermmetaModel $model): int;

    public function get(int $metaId): ?WpTermmetaModel;

    public function getAll(): array;

    public function delete(int $metaId): int;

    public function createModel(array $row): ?WpTermmetaModel;
}