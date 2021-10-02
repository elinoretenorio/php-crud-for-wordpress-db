<?php

declare(strict_types=1);

namespace WordPress\WpComments;

interface IWpCommentsRepository
{
    public function insert(WpCommentsDto $dto): int;

    public function update(WpCommentsDto $dto): int;

    public function get(int $commentId): ?WpCommentsDto;

    public function getAll(): array;

    public function delete(int $commentId): int;
}