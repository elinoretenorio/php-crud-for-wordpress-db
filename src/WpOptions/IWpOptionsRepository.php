<?php

declare(strict_types=1);

namespace WordPress\WpOptions;

interface IWpOptionsRepository
{
    public function insert(WpOptionsDto $dto): int;

    public function update(WpOptionsDto $dto): int;

    public function get(int $optionId): ?WpOptionsDto;

    public function getAll(): array;

    public function delete(int $optionId): int;
}