<?php

declare(strict_types=1);

namespace WordPress\WpLinks;

use JsonSerializable;

class WpLinksModel implements JsonSerializable
{
    private int $linkId;
    private string $linkUrl;
    private string $linkName;
    private string $linkImage;
    private string $linkTarget;
    private string $linkDescription;
    private string $linkVisible;
    private int $linkOwner;
    private int $linkRating;
    private string $linkUpdated;
    private string $linkRel;
    private string $linkNotes;
    private string $linkRss;

    public function __construct(WpLinksDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->linkId = $dto->linkId;
        $this->linkUrl = $dto->linkUrl;
        $this->linkName = $dto->linkName;
        $this->linkImage = $dto->linkImage;
        $this->linkTarget = $dto->linkTarget;
        $this->linkDescription = $dto->linkDescription;
        $this->linkVisible = $dto->linkVisible;
        $this->linkOwner = $dto->linkOwner;
        $this->linkRating = $dto->linkRating;
        $this->linkUpdated = $dto->linkUpdated;
        $this->linkRel = $dto->linkRel;
        $this->linkNotes = $dto->linkNotes;
        $this->linkRss = $dto->linkRss;
    }

    public function getLinkId(): int
    {
        return $this->linkId;
    }

    public function setLinkId(int $linkId): void
    {
        $this->linkId = $linkId;
    }

    public function getLinkUrl(): string
    {
        return $this->linkUrl;
    }

    public function setLinkUrl(string $linkUrl): void
    {
        $this->linkUrl = $linkUrl;
    }

    public function getLinkName(): string
    {
        return $this->linkName;
    }

    public function setLinkName(string $linkName): void
    {
        $this->linkName = $linkName;
    }

    public function getLinkImage(): string
    {
        return $this->linkImage;
    }

    public function setLinkImage(string $linkImage): void
    {
        $this->linkImage = $linkImage;
    }

    public function getLinkTarget(): string
    {
        return $this->linkTarget;
    }

    public function setLinkTarget(string $linkTarget): void
    {
        $this->linkTarget = $linkTarget;
    }

    public function getLinkDescription(): string
    {
        return $this->linkDescription;
    }

    public function setLinkDescription(string $linkDescription): void
    {
        $this->linkDescription = $linkDescription;
    }

    public function getLinkVisible(): string
    {
        return $this->linkVisible;
    }

    public function setLinkVisible(string $linkVisible): void
    {
        $this->linkVisible = $linkVisible;
    }

    public function getLinkOwner(): int
    {
        return $this->linkOwner;
    }

    public function setLinkOwner(int $linkOwner): void
    {
        $this->linkOwner = $linkOwner;
    }

    public function getLinkRating(): int
    {
        return $this->linkRating;
    }

    public function setLinkRating(int $linkRating): void
    {
        $this->linkRating = $linkRating;
    }

    public function getLinkUpdated(): string
    {
        return $this->linkUpdated;
    }

    public function setLinkUpdated(string $linkUpdated): void
    {
        $this->linkUpdated = $linkUpdated;
    }

    public function getLinkRel(): string
    {
        return $this->linkRel;
    }

    public function setLinkRel(string $linkRel): void
    {
        $this->linkRel = $linkRel;
    }

    public function getLinkNotes(): string
    {
        return $this->linkNotes;
    }

    public function setLinkNotes(string $linkNotes): void
    {
        $this->linkNotes = $linkNotes;
    }

    public function getLinkRss(): string
    {
        return $this->linkRss;
    }

    public function setLinkRss(string $linkRss): void
    {
        $this->linkRss = $linkRss;
    }

    public function toDto(): WpLinksDto
    {
        $dto = new WpLinksDto();
        $dto->linkId = (int) ($this->linkId ?? 0);
        $dto->linkUrl = $this->linkUrl ?? "";
        $dto->linkName = $this->linkName ?? "";
        $dto->linkImage = $this->linkImage ?? "";
        $dto->linkTarget = $this->linkTarget ?? "";
        $dto->linkDescription = $this->linkDescription ?? "";
        $dto->linkVisible = $this->linkVisible ?? "";
        $dto->linkOwner = (int) ($this->linkOwner ?? 0);
        $dto->linkRating = (int) ($this->linkRating ?? 0);
        $dto->linkUpdated = $this->linkUpdated ?? "";
        $dto->linkRel = $this->linkRel ?? "";
        $dto->linkNotes = $this->linkNotes ?? "";
        $dto->linkRss = $this->linkRss ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "link_id" => $this->linkId,
            "link_url" => $this->linkUrl,
            "link_name" => $this->linkName,
            "link_image" => $this->linkImage,
            "link_target" => $this->linkTarget,
            "link_description" => $this->linkDescription,
            "link_visible" => $this->linkVisible,
            "link_owner" => $this->linkOwner,
            "link_rating" => $this->linkRating,
            "link_updated" => $this->linkUpdated,
            "link_rel" => $this->linkRel,
            "link_notes" => $this->linkNotes,
            "link_rss" => $this->linkRss,
        ];
    }
}