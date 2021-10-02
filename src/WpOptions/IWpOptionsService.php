<?php

declare(strict_types=1);

namespace WordPress\WpOptions;

interface IWpOptionsService
{
    public function insert(WpOptionsModel $model): int;

    public function update(WpOptionsModel $model): int;

    public function get(int $optionId): ?WpOptionsModel;

    public function getAll(): array;

    public function delete(int $optionId): int;

    public function createModel(array $row): ?WpOptionsModel;
}