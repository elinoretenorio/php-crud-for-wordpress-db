<?php

declare(strict_types=1);

namespace WordPress\WpTermTaxonomy;

interface IWpTermTaxonomyRepository
{
    public function insert(WpTermTaxonomyDto $dto): int;

    public function update(WpTermTaxonomyDto $dto): int;

    public function get(int $termTaxonomyId): ?WpTermTaxonomyDto;

    public function getAll(): array;

    public function delete(int $termTaxonomyId): int;
}