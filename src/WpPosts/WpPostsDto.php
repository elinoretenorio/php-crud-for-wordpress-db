<?php

declare(strict_types=1);

namespace WordPress\WpPosts;

class WpPostsDto 
{
    public int $id;
    public int $postAuthor;
    public string $postDate;
    public string $postDateGmt;
    public string $postContent;
    public string $postTitle;
    public string $postExcerpt;
    public string $postStatus;
    public string $commentStatus;
    public string $pingStatus;
    public string $postPassword;
    public string $postName;
    public string $toPing;
    public string $pinged;
    public string $postModified;
    public string $postModifiedGmt;
    public string $postContentFiltered;
    public int $postParent;
    public string $guid;
    public int $menuOrder;
    public string $postType;
    public string $postMimeType;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->id = (int) ($row["ID"] ?? 0);
        $this->postAuthor = (int) ($row["post_author"] ?? 0);
        $this->postDate = $row["post_date"] ?? "";
        $this->postDateGmt = $row["post_date_gmt"] ?? "";
        $this->postContent = $row["post_content"] ?? "";
        $this->postTitle = $row["post_title"] ?? "";
        $this->postExcerpt = $row["post_excerpt"] ?? "";
        $this->postStatus = $row["post_status"] ?? "";
        $this->commentStatus = $row["comment_status"] ?? "";
        $this->pingStatus = $row["ping_status"] ?? "";
        $this->postPassword = $row["post_password"] ?? "";
        $this->postName = $row["post_name"] ?? "";
        $this->toPing = $row["to_ping"] ?? "";
        $this->pinged = $row["pinged"] ?? "";
        $this->postModified = $row["post_modified"] ?? "";
        $this->postModifiedGmt = $row["post_modified_gmt"] ?? "";
        $this->postContentFiltered = $row["post_content_filtered"] ?? "";
        $this->postParent = (int) ($row["post_parent"] ?? 0);
        $this->guid = $row["guid"] ?? "";
        $this->menuOrder = (int) ($row["menu_order"] ?? 0);
        $this->postType = $row["post_type"] ?? "";
        $this->postMimeType = $row["post_mime_type"] ?? "";
    }
}