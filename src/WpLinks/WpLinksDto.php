<?php

declare(strict_types=1);

namespace WordPress\WpLinks;

class WpLinksDto 
{
    public int $linkId;
    public string $linkUrl;
    public string $linkName;
    public string $linkImage;
    public string $linkTarget;
    public string $linkDescription;
    public string $linkVisible;
    public int $linkOwner;
    public int $linkRating;
    public string $linkUpdated;
    public string $linkRel;
    public string $linkNotes;
    public string $linkRss;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->linkId = (int) ($row["link_id"] ?? 0);
        $this->linkUrl = $row["link_url"] ?? "";
        $this->linkName = $row["link_name"] ?? "";
        $this->linkImage = $row["link_image"] ?? "";
        $this->linkTarget = $row["link_target"] ?? "";
        $this->linkDescription = $row["link_description"] ?? "";
        $this->linkVisible = $row["link_visible"] ?? "";
        $this->linkOwner = (int) ($row["link_owner"] ?? 0);
        $this->linkRating = (int) ($row["link_rating"] ?? 0);
        $this->linkUpdated = $row["link_updated"] ?? "";
        $this->linkRel = $row["link_rel"] ?? "";
        $this->linkNotes = $row["link_notes"] ?? "";
        $this->linkRss = $row["link_rss"] ?? "";
    }
}