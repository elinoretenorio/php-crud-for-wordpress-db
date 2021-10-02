<?php

declare(strict_types=1);

namespace WordPress\WpTerms;

interface IWpTermsRepository
{
    public function insert(WpTermsDto $dto): int;

    public function update(WpTermsDto $dto): int;

    public function get(int $termId): ?WpTermsDto;

    public function getAll(): array;

    public function delete(int $termId): int;
}