<?php

declare(strict_types=1);

namespace WordPress\WpPostmeta;

interface IWpPostmetaService
{
    public function insert(WpPostmetaModel $model): int;

    public function update(WpPostmetaModel $model): int;

    public function get(int $metaId): ?WpPostmetaModel;

    public function getAll(): array;

    public function delete(int $metaId): int;

    public function createModel(array $row): ?WpPostmetaModel;
}