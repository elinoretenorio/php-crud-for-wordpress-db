<?php

declare(strict_types=1);

namespace WordPress\WpCommentmeta;

interface IWpCommentmetaService
{
    public function insert(WpCommentmetaModel $model): int;

    public function update(WpCommentmetaModel $model): int;

    public function get(int $metaId): ?WpCommentmetaModel;

    public function getAll(): array;

    public function delete(int $metaId): int;

    public function createModel(array $row): ?WpCommentmetaModel;
}