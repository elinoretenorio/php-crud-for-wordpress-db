<?php

declare(strict_types=1);

namespace WordPress\WpPostmeta;

use JsonSerializable;

class WpPostmetaModel implements JsonSerializable
{
    private int $metaId;
    private int $postId;
    private string $metaKey;
    private string $metaValue;

    public function __construct(WpPostmetaDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->metaId = $dto->metaId;
        $this->postId = $dto->postId;
        $this->metaKey = $dto->metaKey;
        $this->metaValue = $dto->metaValue;
    }

    public function getMetaId(): int
    {
        return $this->metaId;
    }

    public function setMetaId(int $metaId): void
    {
        $this->metaId = $metaId;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    public function getMetaKey(): string
    {
        return $this->metaKey;
    }

    public function setMetaKey(string $metaKey): void
    {
        $this->metaKey = $metaKey;
    }

    public function getMetaValue(): string
    {
        return $this->metaValue;
    }

    public function setMetaValue(string $metaValue): void
    {
        $this->metaValue = $metaValue;
    }

    public function toDto(): WpPostmetaDto
    {
        $dto = new WpPostmetaDto();
        $dto->metaId = (int) ($this->metaId ?? 0);
        $dto->postId = (int) ($this->postId ?? 0);
        $dto->metaKey = $this->metaKey ?? "";
        $dto->metaValue = $this->metaValue ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "meta_id" => $this->metaId,
            "post_id" => $this->postId,
            "meta_key" => $this->metaKey,
            "meta_value" => $this->metaValue,
        ];
    }
}