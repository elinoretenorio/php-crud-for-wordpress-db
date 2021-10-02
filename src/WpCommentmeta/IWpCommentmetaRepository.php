<?php

declare(strict_types=1);

namespace WordPress\WpCommentmeta;

interface IWpCommentmetaRepository
{
    public function insert(WpCommentmetaDto $dto): int;

    public function update(WpCommentmetaDto $dto): int;

    public function get(int $metaId): ?WpCommentmetaDto;

    public function getAll(): array;

    public function delete(int $metaId): int;
}