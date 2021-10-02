<?php

declare(strict_types=1);

namespace WordPress\WpCommentmeta;

use JsonSerializable;

class WpCommentmetaModel implements JsonSerializable
{
    private int $metaId;
    private int $commentId;
    private string $metaKey;
    private string $metaValue;

    public function __construct(WpCommentmetaDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->metaId = $dto->metaId;
        $this->commentId = $dto->commentId;
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

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function setCommentId(int $commentId): void
    {
        $this->commentId = $commentId;
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

    public function toDto(): WpCommentmetaDto
    {
        $dto = new WpCommentmetaDto();
        $dto->metaId = (int) ($this->metaId ?? 0);
        $dto->commentId = (int) ($this->commentId ?? 0);
        $dto->metaKey = $this->metaKey ?? "";
        $dto->metaValue = $this->metaValue ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "meta_id" => $this->metaId,
            "comment_id" => $this->commentId,
            "meta_key" => $this->metaKey,
            "meta_value" => $this->metaValue,
        ];
    }
}