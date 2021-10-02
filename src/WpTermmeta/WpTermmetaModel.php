<?php

declare(strict_types=1);

namespace WordPress\WpTermmeta;

use JsonSerializable;

class WpTermmetaModel implements JsonSerializable
{
    private int $metaId;
    private int $termId;
    private string $metaKey;
    private string $metaValue;

    public function __construct(WpTermmetaDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->metaId = $dto->metaId;
        $this->termId = $dto->termId;
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

    public function getTermId(): int
    {
        return $this->termId;
    }

    public function setTermId(int $termId): void
    {
        $this->termId = $termId;
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

    public function toDto(): WpTermmetaDto
    {
        $dto = new WpTermmetaDto();
        $dto->metaId = (int) ($this->metaId ?? 0);
        $dto->termId = (int) ($this->termId ?? 0);
        $dto->metaKey = $this->metaKey ?? "";
        $dto->metaValue = $this->metaValue ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "meta_id" => $this->metaId,
            "term_id" => $this->termId,
            "meta_key" => $this->metaKey,
            "meta_value" => $this->metaValue,
        ];
    }
}