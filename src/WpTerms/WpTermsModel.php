<?php

declare(strict_types=1);

namespace WordPress\WpTerms;

use JsonSerializable;

class WpTermsModel implements JsonSerializable
{
    private int $termId;
    private string $name;
    private string $slug;
    private int $termGroup;

    public function __construct(WpTermsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->termId = $dto->termId;
        $this->name = $dto->name;
        $this->slug = $dto->slug;
        $this->termGroup = $dto->termGroup;
    }

    public function getTermId(): int
    {
        return $this->termId;
    }

    public function setTermId(int $termId): void
    {
        $this->termId = $termId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getTermGroup(): int
    {
        return $this->termGroup;
    }

    public function setTermGroup(int $termGroup): void
    {
        $this->termGroup = $termGroup;
    }

    public function toDto(): WpTermsDto
    {
        $dto = new WpTermsDto();
        $dto->termId = (int) ($this->termId ?? 0);
        $dto->name = $this->name ?? "";
        $dto->slug = $this->slug ?? "";
        $dto->termGroup = (int) ($this->termGroup ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "term_id" => $this->termId,
            "name" => $this->name,
            "slug" => $this->slug,
            "term_group" => $this->termGroup,
        ];
    }
}