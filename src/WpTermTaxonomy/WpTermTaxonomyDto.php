<?php

declare(strict_types=1);

namespace WordPress\WpTermTaxonomy;

class WpTermTaxonomyDto 
{
    public int $termTaxonomyId;
    public int $termId;
    public string $taxonomy;
    public string $description;
    public int $parent;
    public int $count;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->termTaxonomyId = (int) ($row["term_taxonomy_id"] ?? 0);
        $this->termId = (int) ($row["term_id"] ?? 0);
        $this->taxonomy = $row["taxonomy"] ?? "";
        $this->description = $row["description"] ?? "";
        $this->parent = (int) ($row["parent"] ?? 0);
        $this->count = (int) ($row["count"] ?? 0);
    }
}