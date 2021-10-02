<?php

declare(strict_types=1);

namespace WordPress\WpPosts;

use JsonSerializable;

class WpPostsModel implements JsonSerializable
{
    private int $id;
    private int $postAuthor;
    private string $postDate;
    private string $postDateGmt;
    private string $postContent;
    private string $postTitle;
    private string $postExcerpt;
    private string $postStatus;
    private string $commentStatus;
    private string $pingStatus;
    private string $postPassword;
    private string $postName;
    private string $toPing;
    private string $pinged;
    private string $postModified;
    private string $postModifiedGmt;
    private string $postContentFiltered;
    private int $postParent;
    private string $guid;
    private int $menuOrder;
    private string $postType;
    private string $postMimeType;

    public function __construct(WpPostsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->id = $dto->id;
        $this->postAuthor = $dto->postAuthor;
        $this->postDate = $dto->postDate;
        $this->postDateGmt = $dto->postDateGmt;
        $this->postContent = $dto->postContent;
        $this->postTitle = $dto->postTitle;
        $this->postExcerpt = $dto->postExcerpt;
        $this->postStatus = $dto->postStatus;
        $this->commentStatus = $dto->commentStatus;
        $this->pingStatus = $dto->pingStatus;
        $this->postPassword = $dto->postPassword;
        $this->postName = $dto->postName;
        $this->toPing = $dto->toPing;
        $this->pinged = $dto->pinged;
        $this->postModified = $dto->postModified;
        $this->postModifiedGmt = $dto->postModifiedGmt;
        $this->postContentFiltered = $dto->postContentFiltered;
        $this->postParent = $dto->postParent;
        $this->guid = $dto->guid;
        $this->menuOrder = $dto->menuOrder;
        $this->postType = $dto->postType;
        $this->postMimeType = $dto->postMimeType;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPostAuthor(): int
    {
        return $this->postAuthor;
    }

    public function setPostAuthor(int $postAuthor): void
    {
        $this->postAuthor = $postAuthor;
    }

    public function getPostDate(): string
    {
        return $this->postDate;
    }

    public function setPostDate(string $postDate): void
    {
        $this->postDate = $postDate;
    }

    public function getPostDateGmt(): string
    {
        return $this->postDateGmt;
    }

    public function setPostDateGmt(string $postDateGmt): void
    {
        $this->postDateGmt = $postDateGmt;
    }

    public function getPostContent(): string
    {
        return $this->postContent;
    }

    public function setPostContent(string $postContent): void
    {
        $this->postContent = $postContent;
    }

    public function getPostTitle(): string
    {
        return $this->postTitle;
    }

    public function setPostTitle(string $postTitle): void
    {
        $this->postTitle = $postTitle;
    }

    public function getPostExcerpt(): string
    {
        return $this->postExcerpt;
    }

    public function setPostExcerpt(string $postExcerpt): void
    {
        $this->postExcerpt = $postExcerpt;
    }

    public function getPostStatus(): string
    {
        return $this->postStatus;
    }

    public function setPostStatus(string $postStatus): void
    {
        $this->postStatus = $postStatus;
    }

    public function getCommentStatus(): string
    {
        return $this->commentStatus;
    }

    public function setCommentStatus(string $commentStatus): void
    {
        $this->commentStatus = $commentStatus;
    }

    public function getPingStatus(): string
    {
        return $this->pingStatus;
    }

    public function setPingStatus(string $pingStatus): void
    {
        $this->pingStatus = $pingStatus;
    }

    public function getPostPassword(): string
    {
        return $this->postPassword;
    }

    public function setPostPassword(string $postPassword): void
    {
        $this->postPassword = $postPassword;
    }

    public function getPostName(): string
    {
        return $this->postName;
    }

    public function setPostName(string $postName): void
    {
        $this->postName = $postName;
    }

    public function getToPing(): string
    {
        return $this->toPing;
    }

    public function setToPing(string $toPing): void
    {
        $this->toPing = $toPing;
    }

    public function getPinged(): string
    {
        return $this->pinged;
    }

    public function setPinged(string $pinged): void
    {
        $this->pinged = $pinged;
    }

    public function getPostModified(): string
    {
        return $this->postModified;
    }

    public function setPostModified(string $postModified): void
    {
        $this->postModified = $postModified;
    }

    public function getPostModifiedGmt(): string
    {
        return $this->postModifiedGmt;
    }

    public function setPostModifiedGmt(string $postModifiedGmt): void
    {
        $this->postModifiedGmt = $postModifiedGmt;
    }

    public function getPostContentFiltered(): string
    {
        return $this->postContentFiltered;
    }

    public function setPostContentFiltered(string $postContentFiltered): void
    {
        $this->postContentFiltered = $postContentFiltered;
    }

    public function getPostParent(): int
    {
        return $this->postParent;
    }

    public function setPostParent(int $postParent): void
    {
        $this->postParent = $postParent;
    }

    public function getGuid(): string
    {
        return $this->guid;
    }

    public function setGuid(string $guid): void
    {
        $this->guid = $guid;
    }

    public function getMenuOrder(): int
    {
        return $this->menuOrder;
    }

    public function setMenuOrder(int $menuOrder): void
    {
        $this->menuOrder = $menuOrder;
    }

    public function getPostType(): string
    {
        return $this->postType;
    }

    public function setPostType(string $postType): void
    {
        $this->postType = $postType;
    }

    public function getPostMimeType(): string
    {
        return $this->postMimeType;
    }

    public function setPostMimeType(string $postMimeType): void
    {
        $this->postMimeType = $postMimeType;
    }

    public function toDto(): WpPostsDto
    {
        $dto = new WpPostsDto();
        $dto->id = (int) ($this->id ?? 0);
        $dto->postAuthor = (int) ($this->postAuthor ?? 0);
        $dto->postDate = $this->postDate ?? "";
        $dto->postDateGmt = $this->postDateGmt ?? "";
        $dto->postContent = $this->postContent ?? "";
        $dto->postTitle = $this->postTitle ?? "";
        $dto->postExcerpt = $this->postExcerpt ?? "";
        $dto->postStatus = $this->postStatus ?? "";
        $dto->commentStatus = $this->commentStatus ?? "";
        $dto->pingStatus = $this->pingStatus ?? "";
        $dto->postPassword = $this->postPassword ?? "";
        $dto->postName = $this->postName ?? "";
        $dto->toPing = $this->toPing ?? "";
        $dto->pinged = $this->pinged ?? "";
        $dto->postModified = $this->postModified ?? "";
        $dto->postModifiedGmt = $this->postModifiedGmt ?? "";
        $dto->postContentFiltered = $this->postContentFiltered ?? "";
        $dto->postParent = (int) ($this->postParent ?? 0);
        $dto->guid = $this->guid ?? "";
        $dto->menuOrder = (int) ($this->menuOrder ?? 0);
        $dto->postType = $this->postType ?? "";
        $dto->postMimeType = $this->postMimeType ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "ID" => $this->id,
            "post_author" => $this->postAuthor,
            "post_date" => $this->postDate,
            "post_date_gmt" => $this->postDateGmt,
            "post_content" => $this->postContent,
            "post_title" => $this->postTitle,
            "post_excerpt" => $this->postExcerpt,
            "post_status" => $this->postStatus,
            "comment_status" => $this->commentStatus,
            "ping_status" => $this->pingStatus,
            "post_password" => $this->postPassword,
            "post_name" => $this->postName,
            "to_ping" => $this->toPing,
            "pinged" => $this->pinged,
            "post_modified" => $this->postModified,
            "post_modified_gmt" => $this->postModifiedGmt,
            "post_content_filtered" => $this->postContentFiltered,
            "post_parent" => $this->postParent,
            "guid" => $this->guid,
            "menu_order" => $this->menuOrder,
            "post_type" => $this->postType,
            "post_mime_type" => $this->postMimeType,
        ];
    }
}