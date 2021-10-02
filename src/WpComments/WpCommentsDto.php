<?php

declare(strict_types=1);

namespace WordPress\WpComments;

class WpCommentsDto 
{
    public int $commentId;
    public int $commentPostId;
    public string $commentAuthor;
    public string $commentAuthorEmail;
    public string $commentAuthorUrl;
    public string $commentAuthorIp;
    public string $commentDate;
    public string $commentDateGmt;
    public string $commentContent;
    public int $commentKarma;
    public string $commentApproved;
    public string $commentAgent;
    public string $commentType;
    public int $commentParent;
    public int $userId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->commentId = (int) ($row["comment_ID"] ?? 0);
        $this->commentPostId = (int) ($row["comment_post_ID"] ?? 0);
        $this->commentAuthor = $row["comment_author"] ?? "";
        $this->commentAuthorEmail = $row["comment_author_email"] ?? "";
        $this->commentAuthorUrl = $row["comment_author_url"] ?? "";
        $this->commentAuthorIp = $row["comment_author_IP"] ?? "";
        $this->commentDate = $row["comment_date"] ?? "";
        $this->commentDateGmt = $row["comment_date_gmt"] ?? "";
        $this->commentContent = $row["comment_content"] ?? "";
        $this->commentKarma = (int) ($row["comment_karma"] ?? 0);
        $this->commentApproved = $row["comment_approved"] ?? "";
        $this->commentAgent = $row["comment_agent"] ?? "";
        $this->commentType = $row["comment_type"] ?? "";
        $this->commentParent = (int) ($row["comment_parent"] ?? 0);
        $this->userId = (int) ($row["user_id"] ?? 0);
    }
}