<?php

declare(strict_types=1);

namespace WordPress\WpTermRelationships;

use JsonSerializable;

class WpTermRelationshipsModel implements JsonSerializable
{
    private int $objectId;
    private int $termTaxonomyId;
    private int $termOrder;

    public function __construct(WpTermRelationshipsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->objectId = $dto->objectId;
        $this->termTaxonomyId = $dto->termTaxonomyId;
        $this->termOrder = $dto->termOrder;
    }

    public function getObjectId(): int
    {
        return $this->objectId;
    }

    public function setObjectId(int $objectId): void
    {
        $this->objectId = $objectId;
    }

    public function getTermTaxonomyId(): int
    {
        return $this->termTaxonomyId;
    }

    public function setTermTaxonomyId(int $termTaxonomyId): void
    {
        $this->termTaxonomyId = $termTaxonomyId;
    }

    public function getTermOrder(): int
    {
        return $this->termOrder;
    }

    public function setTermOrder(int $termOrder): void
    {
        $this->termOrder = $termOrder;
    }

    public function toDto(): WpTermRelationshipsDto
    {
        $dto = new WpTermRelationshipsDto();
        $dto->objectId = (int) ($this->objectId ?? 0);
        $dto->termTaxonomyId = (int) ($this->termTaxonomyId ?? 0);
        $dto->termOrder = (int) ($this->termOrder ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "object_id" => $this->objectId,
            "term_taxonomy_id" => $this->termTaxonomyId,
            "term_order" => $this->termOrder,
        ];
    }
}