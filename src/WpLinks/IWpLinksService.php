<?php

declare(strict_types=1);

namespace WordPress\WpLinks;

interface IWpLinksService
{
    public function insert(WpLinksModel $model): int;

    public function update(WpLinksModel $model): int;

    public function get(int $linkId): ?WpLinksModel;

    public function getAll(): array;

    public function delete(int $linkId): int;

    public function createModel(array $row): ?WpLinksModel;
}