<?php

declare(strict_types=1);

namespace WordPress\WpTermTaxonomy;

use JsonSerializable;

class WpTermTaxonomyModel implements JsonSerializable
{
    private int $termTaxonomyId;
    private int $termId;
    private string $taxonomy;
    private string $description;
    private int $parent;
    private int $count;

    public function __construct(WpTermTaxonomyDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->termTaxonomyId = $dto->termTaxonomyId;
        $this->termId = $dto->termId;
        $this->taxonomy = $dto->taxonomy;
        $this->description = $dto->description;
        $this->parent = $dto->parent;
        $this->count = $dto->count;
    }

    public function getTermTaxonomyId(): int
    {
        return $this->termTaxonomyId;
    }

    public function setTermTaxonomyId(int $termTaxonomyId): void
    {
        $this->termTaxonomyId = $termTaxonomyId;
    }

    public function getTermId(): int
    {
        return $this->termId;
    }

    public function setTermId(int $termId): void
    {
        $this->termId = $termId;
    }

    public function getTaxonomy(): string
    {
        return $this->taxonomy;
    }

    public function setTaxonomy(string $taxonomy): void
    {
        $this->taxonomy = $taxonomy;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getParent(): int
    {
        return $this->parent;
    }

    public function setParent(int $parent): void
    {
        $this->parent = $parent;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function toDto(): WpTermTaxonomyDto
    {
        $dto = new WpTermTaxonomyDto();
        $dto->termTaxonomyId = (int) ($this->termTaxonomyId ?? 0);
        $dto->termId = (int) ($this->termId ?? 0);
        $dto->taxonomy = $this->taxonomy ?? "";
        $dto->description = $this->description ?? "";
        $dto->parent = (int) ($this->parent ?? 0);
        $dto->count = (int) ($this->count ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "term_taxonomy_id" => $this->termTaxonomyId,
            "term_id" => $this->termId,
            "taxonomy" => $this->taxonomy,
            "description" => $this->description,
            "parent" => $this->parent,
            "count" => $this->count,
        ];
    }
}