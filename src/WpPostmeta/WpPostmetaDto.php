<?php

declare(strict_types=1);

namespace WordPress\WpPostmeta;

class WpPostmetaDto 
{
    public int $metaId;
    public int $postId;
    public string $metaKey;
    public string $metaValue;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->metaId = (int) ($row["meta_id"] ?? 0);
        $this->postId = (int) ($row["post_id"] ?? 0);
        $this->metaKey = $row["meta_key"] ?? "";
        $this->metaValue = $row["meta_value"] ?? "";
    }
}