<?php

declare(strict_types=1);

namespace WordPress\WpTermmeta;

class WpTermmetaDto 
{
    public int $metaId;
    public int $termId;
    public string $metaKey;
    public string $metaValue;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->metaId = (int) ($row["meta_id"] ?? 0);
        $this->termId = (int) ($row["term_id"] ?? 0);
        $this->metaKey = $row["meta_key"] ?? "";
        $this->metaValue = $row["meta_value"] ?? "";
    }
}