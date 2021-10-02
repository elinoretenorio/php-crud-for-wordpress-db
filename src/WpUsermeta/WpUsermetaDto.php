<?php

declare(strict_types=1);

namespace WordPress\WpUsermeta;

class WpUsermetaDto 
{
    public int $umetaId;
    public int $userId;
    public string $metaKey;
    public string $metaValue;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->umetaId = (int) ($row["umeta_id"] ?? 0);
        $this->userId = (int) ($row["user_id"] ?? 0);
        $this->metaKey = $row["meta_key"] ?? "";
        $this->metaValue = $row["meta_value"] ?? "";
    }
}