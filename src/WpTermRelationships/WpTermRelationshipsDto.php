<?php

declare(strict_types=1);

namespace WordPress\WpTermRelationships;

class WpTermRelationshipsDto 
{
    public int $objectId;
    public int $termTaxonomyId;
    public int $termOrder;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->objectId = (int) ($row["object_id"] ?? 0);
        $this->termTaxonomyId = (int) ($row["term_taxonomy_id"] ?? 0);
        $this->termOrder = (int) ($row["term_order"] ?? 0);
    }
}