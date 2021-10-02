<?php

declare(strict_types=1);

namespace WordPress\WpLinks;

interface IWpLinksRepository
{
    public function insert(WpLinksDto $dto): int;

    public function update(WpLinksDto $dto): int;

    public function get(int $linkId): ?WpLinksDto;

    public function getAll(): array;

    public function delete(int $linkId): int;
}