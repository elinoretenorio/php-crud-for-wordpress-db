<?php

declare(strict_types=1);

namespace WordPress\WpTerms;

interface IWpTermsService
{
    public function insert(WpTermsModel $model): int;

    public function update(WpTermsModel $model): int;

    public function get(int $termId): ?WpTermsModel;

    public function getAll(): array;

    public function delete(int $termId): int;

    public function createModel(array $row): ?WpTermsModel;
}