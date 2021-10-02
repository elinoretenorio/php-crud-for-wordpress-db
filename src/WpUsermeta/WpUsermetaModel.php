<?php

declare(strict_types=1);

namespace WordPress\WpUsermeta;

use JsonSerializable;

class WpUsermetaModel implements JsonSerializable
{
    private int $umetaId;
    private int $userId;
    private string $metaKey;
    private string $metaValue;

    public function __construct(WpUsermetaDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->umetaId = $dto->umetaId;
        $this->userId = $dto->userId;
        $this->metaKey = $dto->metaKey;
        $this->metaValue = $dto->metaValue;
    }

    public function getUmetaId(): int
    {
        return $this->umetaId;
    }

    public function setUmetaId(int $umetaId): void
    {
        $this->umetaId = $umetaId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
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

    public function toDto(): WpUsermetaDto
    {
        $dto = new WpUsermetaDto();
        $dto->umetaId = (int) ($this->umetaId ?? 0);
        $dto->userId = (int) ($this->userId ?? 0);
        $dto->metaKey = $this->metaKey ?? "";
        $dto->metaValue = $this->metaValue ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "umeta_id" => $this->umetaId,
            "user_id" => $this->userId,
            "meta_key" => $this->metaKey,
            "meta_value" => $this->metaValue,
        ];
    }
}