<?php

declare(strict_types=1);

namespace WordPress\WpComments;

use WordPress\Database\IDatabase;
use WordPress\Database\DatabaseException;

class WpCommentsRepository implements IWpCommentsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(WpCommentsDto $dto): int
    {
        $sql = "INSERT INTO `wp_comments` (`comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->commentPostId,
                $dto->commentAuthor,
                $dto->commentAuthorEmail,
                $dto->commentAuthorUrl,
                $dto->commentAuthorIp,
                $dto->commentDate,
                $dto->commentDateGmt,
                $dto->commentContent,
                $dto->commentKarma,
                $dto->commentApproved,
                $dto->commentAgent,
                $dto->commentType,
                $dto->commentParent,
                $dto->userId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(WpCommentsDto $dto): int
    {
        $sql = "UPDATE `wp_comments` SET `comment_post_ID` = ?, `comment_author` = ?, `comment_author_email` = ?, `comment_author_url` = ?, `comment_author_IP` = ?, `comment_date` = ?, `comment_date_gmt` = ?, `comment_content` = ?, `comment_karma` = ?, `comment_approved` = ?, `comment_agent` = ?, `comment_type` = ?, `comment_parent` = ?, `user_id` = ?
                WHERE `comment_ID` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->commentPostId,
                $dto->commentAuthor,
                $dto->commentAuthorEmail,
                $dto->commentAuthorUrl,
                $dto->commentAuthorIp,
                $dto->commentDate,
                $dto->commentDateGmt,
                $dto->commentContent,
                $dto->commentKarma,
                $dto->commentApproved,
                $dto->commentAgent,
                $dto->commentType,
                $dto->commentParent,
                $dto->userId,
                $dto->commentId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $commentId): ?WpCommentsDto
    {
        $sql = "SELECT `comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`
                FROM `wp_comments` WHERE `comment_ID` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$commentId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new WpCommentsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`
                FROM `wp_comments`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new WpCommentsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $commentId): int
    {
        $sql = "DELETE FROM `wp_comments` WHERE `comment_ID` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$commentId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}