<?php

declare(strict_types=1);

namespace WordPress\WpTermTaxonomy;

interface IWpTermTaxonomyService
{
    public function insert(WpTermTaxonomyModel $model): int;

    public function update(WpTermTaxonomyModel $model): int;

    public function get(int $termTaxonomyId): ?WpTermTaxonomyModel;

    public function getAll(): array;

    public function delete(int $termTaxonomyId): int;

    public function createModel(array $row): ?WpTermTaxonomyModel;
}