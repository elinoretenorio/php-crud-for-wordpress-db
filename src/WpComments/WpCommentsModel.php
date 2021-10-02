<?php

declare(strict_types=1);

namespace WordPress\WpComments;

use JsonSerializable;

class WpCommentsModel implements JsonSerializable
{
    private int $commentId;
    private int $commentPostId;
    private string $commentAuthor;
    private string $commentAuthorEmail;
    private string $commentAuthorUrl;
    private string $commentAuthorIp;
    private string $commentDate;
    private string $commentDateGmt;
    private string $commentContent;
    private int $commentKarma;
    private string $commentApproved;
    private string $commentAgent;
    private string $commentType;
    private int $commentParent;
    private int $userId;

    public function __construct(WpCommentsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->commentId = $dto->commentId;
        $this->commentPostId = $dto->commentPostId;
        $this->commentAuthor = $dto->commentAuthor;
        $this->commentAuthorEmail = $dto->commentAuthorEmail;
        $this->commentAuthorUrl = $dto->commentAuthorUrl;
        $this->commentAuthorIp = $dto->commentAuthorIp;
        $this->commentDate = $dto->commentDate;
        $this->commentDateGmt = $dto->commentDateGmt;
        $this->commentContent = $dto->commentContent;
        $this->commentKarma = $dto->commentKarma;
        $this->commentApproved = $dto->commentApproved;
        $this->commentAgent = $dto->commentAgent;
        $this->commentType = $dto->commentType;
        $this->commentParent = $dto->commentParent;
        $this->userId = $dto->userId;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function setCommentId(int $commentId): void
    {
        $this->commentId = $commentId;
    }

    public function getCommentPostId(): int
    {
        return $this->commentPostId;
    }

    public function setCommentPostId(int $commentPostId): void
    {
        $this->commentPostId = $commentPostId;
    }

    public function getCommentAuthor(): string
    {
        return $this->commentAuthor;
    }

    public function setCommentAuthor(string $commentAuthor): void
    {
        $this->commentAuthor = $commentAuthor;
    }

    public function getCommentAuthorEmail(): string
    {
        return $this->commentAuthorEmail;
    }

    public function setCommentAuthorEmail(string $commentAuthorEmail): void
    {
        $this->commentAuthorEmail = $commentAuthorEmail;
    }

    public function getCommentAuthorUrl(): string
    {
        return $this->commentAuthorUrl;
    }

    public function setCommentAuthorUrl(string $commentAuthorUrl): void
    {
        $this->commentAuthorUrl = $commentAuthorUrl;
    }

    public function getCommentAuthorIp(): string
    {
        return $this->commentAuthorIp;
    }

    public function setCommentAuthorIp(string $commentAuthorIp): void
    {
        $this->commentAuthorIp = $commentAuthorIp;
    }

    public function getCommentDate(): string
    {
        return $this->commentDate;
    }

    public function setCommentDate(string $commentDate): void
    {
        $this->commentDate = $commentDate;
    }

    public function getCommentDateGmt(): string
    {
        return $this->commentDateGmt;
    }

    public function setCommentDateGmt(string $commentDateGmt): void
    {
        $this->commentDateGmt = $commentDateGmt;
    }

    public function getCommentContent(): string
    {
        return $this->commentContent;
    }

    public function setCommentContent(string $commentContent): void
    {
        $this->commentContent = $commentContent;
    }

    public function getCommentKarma(): int
    {
        return $this->commentKarma;
    }

    public function setCommentKarma(int $commentKarma): void
    {
        $this->commentKarma = $commentKarma;
    }

    public function getCommentApproved(): string
    {
        return $this->commentApproved;
    }

    public function setCommentApproved(string $commentApproved): void
    {
        $this->commentApproved = $commentApproved;
    }

    public function getCommentAgent(): string
    {
        return $this->commentAgent;
    }

    public function setCommentAgent(string $commentAgent): void
    {
        $this->commentAgent = $commentAgent;
    }

    public function getCommentType(): string
    {
        return $this->commentType;
    }

    public function setCommentType(string $commentType): void
    {
        $this->commentType = $commentType;
    }

    public function getCommentParent(): int
    {
        return $this->commentParent;
    }

    public function setCommentParent(int $commentParent): void
    {
        $this->commentParent = $commentParent;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function toDto(): WpCommentsDto
    {
        $dto = new WpCommentsDto();
        $dto->commentId = (int) ($this->commentId ?? 0);
        $dto->commentPostId = (int) ($this->commentPostId ?? 0);
        $dto->commentAuthor = $this->commentAuthor ?? "";
        $dto->commentAuthorEmail = $this->commentAuthorEmail ?? "";
        $dto->commentAuthorUrl = $this->commentAuthorUrl ?? "";
        $dto->commentAuthorIp = $this->commentAuthorIp ?? "";
        $dto->commentDate = $this->commentDate ?? "";
        $dto->commentDateGmt = $this->commentDateGmt ?? "";
        $dto->commentContent = $this->commentContent ?? "";
        $dto->commentKarma = (int) ($this->commentKarma ?? 0);
        $dto->commentApproved = $this->commentApproved ?? "";
        $dto->commentAgent = $this->commentAgent ?? "";
        $dto->commentType = $this->commentType ?? "";
        $dto->commentParent = (int) ($this->commentParent ?? 0);
        $dto->userId = (int) ($this->userId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "comment_ID" => $this->commentId,
            "comment_post_ID" => $this->commentPostId,
            "comment_author" => $this->commentAuthor,
            "comment_author_email" => $this->commentAuthorEmail,
            "comment_author_url" => $this->commentAuthorUrl,
            "comment_author_IP" => $this->commentAuthorIp,
            "comment_date" => $this->commentDate,
            "comment_date_gmt" => $this->commentDateGmt,
            "comment_content" => $this->commentContent,
            "comment_karma" => $this->commentKarma,
            "comment_approved" => $this->commentApproved,
            "comment_agent" => $this->commentAgent,
            "comment_type" => $this->commentType,
            "comment_parent" => $this->commentParent,
            "user_id" => $this->userId,
        ];
    }
}