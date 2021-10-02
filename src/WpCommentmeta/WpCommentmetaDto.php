<?php

declare(strict_types=1);

namespace WordPress\WpCommentmeta;

class WpCommentmetaDto 
{
    public int $metaId;
    public int $commentId;
    public string $metaKey;
    public string $metaValue;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->metaId = (int) ($row["meta_id"] ?? 0);
        $this->commentId = (int) ($row["comment_id"] ?? 0);
        $this->metaKey = $row["meta_key"] ?? "";
        $this->metaValue = $row["meta_value"] ?? "";
    }
}