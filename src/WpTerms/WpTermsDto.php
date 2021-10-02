<?php

declare(strict_types=1);

namespace WordPress\WpTerms;

class WpTermsDto 
{
    public int $termId;
    public string $name;
    public string $slug;
    public int $termGroup;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->termId = (int) ($row["term_id"] ?? 0);
        $this->name = $row["name"] ?? "";
        $this->slug = $row["slug"] ?? "";
        $this->termGroup = (int) ($row["term_group"] ?? 0);
    }
}